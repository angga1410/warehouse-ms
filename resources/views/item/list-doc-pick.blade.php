@extends('layout.admin.base')
@section('stylesheet')
<style>
.modal-lg {
    max-width: 80%!important;
}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="reportList">
<input type="hidden" id="token" value="{{csrf_token()}}">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Receive Report List</h3>
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
                <a href="{{url('/new-doc-request')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Document</span>
                    </span>
                </a>
            </div>
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="report_list">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Document</th>
                                <th>Source</th>
                                <th>Request By</th>

                                <th>Purpose</th>
                                <th>Remark</th>
                                <th>Date</th>
                                <th style="width: 130px;">Action</th>
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
        $("#report_list").DataTable({
            "processing": true,
            "serverSide": true,
            "searching": false,
            scrollY: 500,
               info:false,
            dom: 'Bfrtip',
    paging: false,
             ajax: {
                'url':"/request-doc-dt", 
                'type':"get",
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
                data: "source"
            },
            {
                data: function(data){
                    return data.employee.first_name+" "+data.employee.middle_name
                }
            },
    
            {
                data: "purpose"
            }
            , {
                data: "remark"
            } , {
                data: "created_at"
            },
            {
                
                data: function(data){
                    return ' <a href="/request-doc-print/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-print"></i></a> <a href="/request-doc-del/'+data.id+'" class=" btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
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
                    url:"/report-detail-list/"+input.id,
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
                url:"/delete-report",
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
