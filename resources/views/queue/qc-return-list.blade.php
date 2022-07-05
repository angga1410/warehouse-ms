@extends('layout.admin.base')
@section('stylesheet')
<style>
.modal-lg {
    max-width: 80%!important;
}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="qcReturnItems">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Return List</h3>
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
                <a href="{{url('/qcReturn')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Qc Return</span>
                    </span>
                </a>
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="qcReturn_list">
                        <thead>
                            <tr>
                                <th>qc Return Id</th>
                                <th>Qc Request</th>
                                <th>Document No.</th>
                                <!-- <th>Supplier</th>
                                <th>Supplier Contact</th> -->
                                <th>Mover</th>
                                <th>Remark</th>
                                <th>Is Verified</th>
                                <th style="width: 80px;">Action</th>
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
        $("#qcReturn_list").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url":"/qcReturn-dt", 
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
                data: "qc_request_id"
            },
            {
                data: "document_no"
            },
            // {
            //     data: function(data){
            //         return data.supplier.name
            //     }
            // },
            // {
            //     data: "supplier_contact"
            // },
            {
                data: function(data){
                    return data.mover.name
                }
            },
            {
                data: "remark"
            },
            {
                data: function(data){
                    if(data.is_verified == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Pending</span>';
                    }else if(data.is_verified == 1)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Approve</span>';
                    }else if(data.is_verified == 2)
                    {
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Reject</span>';
                    }
                    
                }
            },
            {
                
                data: function(data){
                    return ' <a href="/update-return/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
             ],
             "drawCallback":function(setting){

            //     $("#qcReturn_list .edit").on("click",function(e){
            //     e.preventDefault();
            //     var input = $('#qcReturn_list').DataTable().row($(this).parents('tr')).data();
            //     $.ajax({
            //         url:"/edit-qcReturn",
            //         method:"post",
            //         data:{'id':input.id,'_token':$("#token").val()},
            //         success:function(data){
            //             alert("Successfully Change Status.");
            //             $("#qcReturn_list").DataTable().draw();
            //         },
            //         error:function(data){
            //             alert("There is some internal error");
            //         }
            //     });
            // });
            $("#qcReturn_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#qcReturn_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-qc-return",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        
                        alert("Successfully Serial No. Deleted.");
                        $("#qcReturn_list").DataTable().draw();
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
<!-- <a href="#" style="text-decoration: none;" class="edit btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air btn-sm"><i class="la la-check"></i></a>
 -->
