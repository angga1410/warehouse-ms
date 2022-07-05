@extends('layout.admin.base')
@section('stylesheet')
<style>
.modal-lg {
    max-width: 80%!important;
}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="storeitemRequest">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Store Item Request List</h3>
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
                <a href="{{url('/new-storeitem-request')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Store Item Request</span>
                    </span>
                </a>
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="storeitem_request">
                        <thead>
                            <tr>
                                <th>Request No.</th>
                                <th>Reference</th>
                                <th>Source Type</th>
                                <!-- <th>Source Name</th> -->
                                <th>Requester</th>
                                <th>MR Date</th>
                                <th>Status</th>
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
        $("#storeitem_request").DataTable({
            "processing": true,
            "serverSide": true,
             ajax: {
                'url':"/storeitem-request-dt", 
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
                data: "reference"
            },
            {
                data: "source_type"
            },
            // {
            //     data: function(data){
            //         return data.supplier.name
            //     }
            // },
            {
                data: function(data){
                    return data.user.name
                }
            }
            , {
                data: "created_at"
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
                    else{
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Decline</span>';
                    }
                }
            },
            {
                
                data: function(data){
                    return '<a href="/edit-storeitem-request/'+data.id+'" style="text-decoration: none;" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
             ],
             "drawCallback":function(setting){
                $("#storeitem_request .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#storeitem_request').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-sir",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        
                        alert("Successfully Store Item Request Deleted.");
                        $("#storeitem_request").DataTable().draw();
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
