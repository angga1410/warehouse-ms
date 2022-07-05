var DatatablesDataSourceAjaxClient= {
    init:function() {
        var warehouseId = $("#warehouse").val();

        $("#warehouse_location_list").DataTable( {
            responsive:!0, ajax: {
                url:"/warehouse-location-list-dt", type:"POST", data: {
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
                data: "zone"
            },
            {
                data: function(data){
                    return data.warehouse.name
                }
            },
            {
                data: "zone_description"
            }
            , {
                data: function(data){
                    return '<a href="/warehouse-location/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
            ]   , columnDefs:[{
                // targets:3, render:function(data) {
                //     return null;
                //}
            }
            ],
            "drawCallback":function(setting){

                $("#warehouse_location_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#warehouse_location_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-warehouse-location",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Warehouse Location Deleted.");
                        $("#warehouse_location_list").DataTable().draw();
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

if($('#warehouseLocationList').length !== 0) {
    DatatablesDataSourceAjaxClient.init();

    $("#warehouse").on("change", function(){
        $("#warehouse_location_list").DataTable().column(2).search($(this).val()).draw();
    });
}