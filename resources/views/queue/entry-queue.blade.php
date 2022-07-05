@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="entryQueue">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Entry Queue List</h3>
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
                <a href="{{url('/new-entry-queue')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Entry Queue</span>
                    </span>
                </a>
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="entry_queue">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Queue Id</th>
                                <th>Document No.</th>
                                <th>Mover</th>
                                <th>Employee</th>
                                <th>Date</th>
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
        $("#entry_queue").DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                'url':"/entry-queue-dt", 
                'type':"post",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[ 
            {
                data: "id"
            },
            {
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
            },
            {
                data: function(data){
                    return '<a href="/update-queue/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
            ],
             "drawCallback":function(setting){

            $("#entry_queue .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#entry_queue').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-entryQueue",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Queue Data Deleted.");
                        $("#entry_queue").DataTable().draw();
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
