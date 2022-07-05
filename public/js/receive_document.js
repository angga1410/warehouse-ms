var DatatablesDataSourceAjaxClient= {
    init:function() {
        $("#receive_document").DataTable( {
            responsive:!0, ajax: {
                url:"/receive-document-dt", type:"GET", data: {
                    pagination: {
                        perpage: 50
                    }
                }
            }
            , columns:[ {
                data: "document_no"
            }
            ,{
                data: function(data){
                    return data.user.name
                }
            }
            ,{
                data: "reference"
            }
            , {
                data: "sender_name"
            }
            , {
                data: "source_name"
            }
            , {
                data: function(data){
                    return data.mover.name
                }
            }
            , {
                data: function(data){
                    if(data.item_linked == 1){
                        return "Yes";
                    }else{
                        return "No";
                    }
                }
            }
            , {
                data: function(data){
                    return '<a href="/edit-receive-document/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            }
            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
            ],
            "drawCallback":function(setting){

                $("#receive_document .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#receive_document').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-receive-document",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Document Deleted.");
                        $("#receive_document").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            }
        }
        )
    }
};

if($('#receiveDocument').length !== 0) {
    DatatablesDataSourceAjaxClient.init()
}