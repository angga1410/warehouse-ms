var DatatablesDataSourceAjaxClient= {
    init:function() {
        $("#customer_list").DataTable( {
            responsive:!0, ajax: {
                url:"/customer-list-dt", type:"GET", data: {
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
                data: "address"
            },
            {
                data: "city"
            },
            {
                data: "lantitude"
            },
            {
                data: "longitude"
            },
            {
                data: function(data){
                    return '<a href="/customer/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
            ],
            "drawCallback":function(setting){

                $("#customer_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#customer_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-customer",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Customer Deleted.");
                        $("#customer_list").DataTable().draw();
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

if($('#customerList').length !== 0) {
    DatatablesDataSourceAjaxClient.init()
}