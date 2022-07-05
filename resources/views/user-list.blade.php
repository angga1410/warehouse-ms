@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="moverList">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">User List</h3>
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
                <!-- <a href="{{url('/new-mover')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Mover</span>
                    </span>
                </a> -->
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="user_list">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Approve</th>
                                <th>Action</th>
                            </tr>
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
        $("#user_list").DataTable( {
            "processing": true,
            "serverSide": true,
            ajax: {
                'url':"/userList-dt",
                'type':"post",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[ {
                data: "id"
            }
            , {
                data: "name",
                name: "name",
                searchable: "true"
            }
            , {
                data: "email"
            },
            {
                data: "department"
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Pending</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Approve</span>';
                    }
                    
                }
            },
            {
                data: function(data){
                    return '<a href="#" style="text-decoration: none;" class="edit btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air btn-sm"><i class="la la-check"></i></a>';
                }
            },
            {
                data: function(data){
                    return '<a href="/update-user/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
            ],
             "drawCallback":function(setting){

                $("#user_list .edit").on("click",function(e){
                e.preventDefault();
                var input = $('#user_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/edit-user",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Approved User.");
                        $("#user_list").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });

            $("#user_list .delete").on("click",function(e){
            e.preventDefault();
            var input = $('#user_list').DataTable().row($(this).parents('tr')).data();
            $.ajax({
                url:"/delete-user",
                method:"post",
                data:{'id':input.id,'_token':$("#token").val()},
                success:function(data){
                    
                    alert("Successfully User Deleted.");
                    $("#user_list").DataTable().draw();
                },
                error:function(data){
                    alert("There is some internal error");
                }
            });
        });
             }
        })
    });
</script>
@endsection
