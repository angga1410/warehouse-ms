var DatatablesDataSourceAjaxClient= {
    init:function() {
        $("#task_list").DataTable( {
            responsive:!0, ajax: {
                url:"/task-list-dt", 
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
                data: "task_desc"
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

if($('#taskList').length !== 0) {
    DatatablesDataSourceAjaxClient.init()
}