@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="taskList">
@include('flash::message')
    <div class="m-subheader ">
    <div class="row">

            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Task List</h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                        </h3>
                    </div>
                </div>
             
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="task_list">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Task</th>
                                <th>Task Description</th>
                               
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function(){
        $("#task_list").DataTable( {
            "processing": true,
            "serverSide": true,
            ajax: {
                'url':"/task-list-dt", 
                'type':"post", 
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
        });
    });
</script>
@endsection
