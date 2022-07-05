@extends('layout.admin.base')
@section('stylesheet')
<style>
.modal-lg {
    max-width: 80%!important;
}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="sendingDoItems">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Sending DO Items List</h3>
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
                <a href="{{url('/sendingDo')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Sending Do Item</span>
                    </span>
                </a>
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="sending_item_list">
                        <thead>
                            <tr>
                                <th>Sending Do Id</th>
                                <th>Reference No.</th>
                                <th>Send Via</th>
                                <th>Do</th>
                                <th>Hand-over By</th>
                                <th>contact</th>
                                <th>Sender</th>
                                <th>Pickup Date-Time</th>
                                <th>Is Deliverd</th>
                                <th>Deliver</th>
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
        $("#sending_item_list").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url":"/sendingDo-dt",
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
                data: "packing_items_id"
            },
            {
                data: "send_via"
            },
            {
                data: function(data){
                    return data.do_user.name
                }
            },
            {
                data: function(data){
                    return data.handover_by_user.name
                }
            },
            {
                data: "contact"
            },
            {
                data: function(data){
                    return data.sender.name
                }
            },
            {
                data: "pickup_date"
            },
            {
                data: function(data){
                    if(data.is_delivered == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Process</span>';
                    }else if(data.is_delivered == 1)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Delivered</span>';
                    }
                    
                }
            },
            {
                
                data: function(data){
                    return '<a href="#" style="text-decoration: none;" class="edit btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air btn-sm"><i class="la la-check"></i></a>';
                }
            },
             ],
             "drawCallback":function(setting){

                $("#sending_item_list .edit").on("click",function(e){
                e.preventDefault();
                var input = $('#sending_item_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/edit-sendingDo",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Delivered.");
                        $("#sending_item_list").DataTable().draw();
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
