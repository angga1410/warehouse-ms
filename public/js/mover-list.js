var DatatablesDataSourceAjaxClient= {
    init:function() {
        $("#mover_list").DataTable( {
            responsive:!0, ajax: {
                url:"/mover-list-dt", type:"GET", data: {
                    pagination: {
                        perpage: 50
                    }
                }
            }
            , columns:[ {
                data: "id"
            }
            , {
                data: "name"
            }
            , {
                data: "description"
            },
            {
                data: function(data){
                    return '<a href="/mover/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
            ],
            "drawCallback":function(setting){

                $("#mover_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#mover_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-mover",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Mover Deleted.");
                        $("#mover_list").DataTable().draw();
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

if($('#moverList').length !== 0) {
    DatatablesDataSourceAjaxClient.init()
}