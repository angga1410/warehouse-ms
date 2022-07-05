var DatatablesDataSourceAjaxClient= {
    init:function() {
        var warehouseId = $("#warehouse").val();

        $("#warehouse_racking_list").DataTable( {
            responsive:!0, ajax: {
                url:"/warehouse-racking-list-dt", type:"POST", data: {
                    pagination: {
                        perpage: 50
                    }
                },
                headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            },
            "columnDefs": [
                { className: "hide_column", "targets": [6,7] }
            ],
            columns:[ {
                data: "id"
            }
            , {
                data: "rack"
            },{
                data: "rack_desc"
            },{
                data: "level"
            },
            {
                data: "bin"
            }
            , {
                data: function(data){
                    return '<a href="/warehouse-racking/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
            ]   , columnDefs:[{
                // targets:3, render:function(data) {
                //     return null;
                //}
            }
            ],
            "drawCallback":function(setting){

                $("#warehouse_racking_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#warehouse_racking_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-warehouse-racking",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Warehouse racking Deleted.");
                        $("#warehouse_racking_list").DataTable().draw();
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

if($('#warehouseRackingList').length !== 0) {
    DatatablesDataSourceAjaxClient.init();

    $("#warehouse").on("change", function(){
        $("#warehouse_racking_list").DataTable().column(2).search($(this).val()).draw();
    });
}