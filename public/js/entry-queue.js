var DatatablesDataSourceAjaxClient= {
    init:function() {
        $("#entry_queue").DataTable( {
            responsive:!0, ajax: {
                url:"/entry-queue-dt", type:"GET", data: {
                    pagination: {
                        perpage: 50
                    }
                }
            }
            , columns:[ {
                data: "queue_id"
            }
            , {
                data: "document_no"
            }
            , {
                data: function(data){
                    return data.mover.name;
                }
            }
            , {
                data: function(data){
                    return data.user.name
                }
            }
            , {
                data: "created_at"
            }
            
            ],
        })
    }
};

if($('#entryQueue').length !== 0) {
    DatatablesDataSourceAjaxClient.init()
}