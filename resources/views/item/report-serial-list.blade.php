@extends('layout.admin.base')
@section('stylesheet')
<style>
.modal-lg {
    max-width: 80%!important;
}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="reportlList">
<input type="hidden" id="token" value="{{csrf_token()}}">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Receive Report Serial No List</h3>
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
                <a href="{{url('/new-report')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Report</span>
                    </span>
                </a>
            </div>
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="report_list_no">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Document No.</th>
                                <th>Reference Type</th>
                                <th>Source Type</th>
                                <th>Source Name</th>
                                <th>Mover</th>
                                <th>Sender</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th style="width: 83px;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="m_modal_report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group table-responsive">
                    <table class="table table-bordered m-table report_detail_tbl">
                    <tr>
                      <th class="first">ID</th>
                      <th class="first">Mfr.</th>
                      <th>Part Number</th>
                      <th class="second">Part Name</th>
                      <th class="third">Description</th>
                      <th class="seventh">Qty Receive</th>
                      <th class="eighth">U/M</th>
                    </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function(){
        $("#report_list_no").DataTable({
            "processing": true,
            "serverSide": true,
             ajax: {
                'url':"/report-serial-list-dt",
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
                data: "document_no"
            },
            {
                data: "reference_type"
            },
            {
                data: "source_type"
            },
            {
                data: function(data){
                    return data.supplier.name
                }
            },
            {
                data: function(data){
                    return data.mover.name
                }
            }
            ,{
                data: "sender"
            }
            , {
                data: "created_at"
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Processing</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--info m-badge--wide m--font-light">sent</span>';
                    }
                    else if(data.status == 2)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Receive in warehouse</span>';
                    }
                    else if(data.status == 3)
                    {
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">store in warehouse</span>';
                    }

                }
            },
            {

                data: function(data){
                    return '<a href="#" style="text-decoration: none;" data-toggle="modal" data-target="#m_modal_report" class="view btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-eye"></i></a> <a href="/update-report/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },

            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
             ],
            "drawCallback":function(setting){

                $("#report_list .view").on("click",function(e){
                $(".rdetail_tr").empty();
                e.preventDefault();
                var input = $('#report_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/report-detail-list-serial/"+input.id,
                    method:"get",
                    success:function(data){

                        $.each( data, function( key, value ) {
                          console.log(value);
                          $(".report_detail_tbl").append('<tr class="rdetail_tr">'+
                            '<td>'+value.products.id+'</td>'+
                            '<td>'+value.products.mfr+'</td>'+
                            '<td>'+value.products.part_num+'</td>'+
                            '<td>'+value.products.part_name+'</td>'+
                            '<td>'+value.products.part_desc+'</td>'+
                            '<td>'+value.qty_receive+'</td>'+
                            '<td>'+value.products.default_um+'</td>'+
                            '</tr>');

                        });

                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });

             $("#report_list .delete").on("click",function(e){
            e.preventDefault();
            var input = $('#report_list').DataTable().row($(this).parents('tr')).data();
            $.ajax({
                url:"/delete-report-serial",
                method:"post",
                data:{'id':input.id,'_token':$("#token").val()},
                success:function(data){

                    alert("Successfully User Deleted.");
                    $("#report_list").DataTable().draw();
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
