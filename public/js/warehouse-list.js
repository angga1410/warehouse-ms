var DatatablesDataSourceAjaxClient= {
    init:function() {
        $("#warehouse_list").DataTable( {
            responsive:!0, ajax: {
                url:"/warehouse-list-dt", 
                type:"GET", 
                data: {
                    pagination: {
                        perpage: 10
                    },
                }
            }
            , columns:[ {
                data: "id"
            }
            , {
                data: "name"
            }
            , {
                data: function(data){
                    return '<a href="/warehouse/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            }
            ], 
            // columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
            // ],
            "drawCallback":function(setting){

                $("#warehouse_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#warehouse_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-warehouse",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Warehouse Deleted.");
                        $("#warehouse_list").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            }
        })
    }
};

if($('#warehouseList').length !== 0) {
    DatatablesDataSourceAjaxClient.init()
}