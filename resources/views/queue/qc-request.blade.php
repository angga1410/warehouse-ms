@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="qcRequest">
@include('flash::message')
  
    <div class="row>">
    <!-- Area Chart -->
<!-- <div class="col-xl-5 col-lg-4"> -->

<!-- Pie Chart -->
<!-- <div class="col-xl-4 col-lg-5"> -->
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold">Outstanding QC</h4>
    
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-pie pt-4 pb-2">
      <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="qc_outstanding">
                        <thead>
                            <tr>
                                <th>Qc-Request Id</th>
                                <!-- <th>Queue Id</th> -->
                                <th>Document No.</th>
                                <th>Qc By</th>
                                <th>Remark</th>
                                <th>Date</th>
                                <th>Status</th>
                                <!-- <th>Is Verified</th> -->
                                <th style="width:80px;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        <canvas id="myPieChart"></canvas>
      </div>
    
    </div>
  </div>
<!-- </div> -->
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
                <!-- <a href="{{url('/new-qc-request')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Qc Request</span>
                    </span>
                </a> -->
            </div>
            <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Qc Status</h3>
            </div>
        </div>
    </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="qc_request">
                        <thead>
                            <tr>
                                <th>Qc-Request Id</th>
                                <!-- <th>Queue Id</th> -->
                                <th>Document No.</th>
                                <th>Qc By</th>
                                <th>Remark</th>
                                <th>Date</th>
                                <th>Status</th>
                            
                                <th style="width:80px;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

   

<div class="modal fade " id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Qc Request Item Parts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group table-responsive">
                    <table class="table table-bordered m-table qcitem_parts_tbl">
                        <tr>
                          <th class="first">Mfr.</th>
                          <th>Product Number</th>
                          <th class="second">Part Name</th>
                          <th class="third">Description</th>
                          <th class="fourth">Qty Qc</th>
                          <th class="fifth">U/M</th>
                          <th class="fourth">Qc Rejected</th>

                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade " id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Qc Request Item Parts Outstanding</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group table-responsive">
                    <table class="table table-bordered m-table qcitem_parts_tbl2">
                        <tr>
                          <th class="first">Mfr.</th>
                          <th>Product Number</th>
                          <th class="second">Part Name</th>
                          <th class="third">Description</th>
                          <th class="fourth">Qty Qc</th>
                          <th class="fifth">U/M</th>
                         

                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(function(){
        $("#qc_request").DataTable( {
            "processing": true,
            "serverSide": true,
            ajax: {
                'url': '/qcRequestlist-dt',
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
                 data: function(data){
                    return data.document.reference_rr
                }
            },
            {
                 data: function(data){
                    return data.user.name
                }
            },
            {
                data: "remark"
            },
            {
                data: "created_at"
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Outstanding</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--info m-badge--wide m--font-light">On Progress</span>';
                    }else if(data.status == 2)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Pass QC</span>';
                    }else if(data.status == 3)
                    {
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">QC Rejected</span>';
                    }else if(data.status == 4)
                    {
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">QC Partial Rejected</span>';
                    }

                }
            },

            {

                data: function(data){
                    return '<a style="text-decoration: none;" href="#" data-toggle="modal" data-target="#m_modal_1" class="view btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-eye"></i></a> <a href="/edit-qcRequest/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },

          
             ],
            "drawCallback":function(setting){

            $("#qc_request .view").on("click",function(e){
                $(".detail_tr").empty();
                e.preventDefault();
                var input = $('#qc_request').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/qc-request-parts-list/"+input.id,
                    method:"get",
                    success:function(data){

                        $.each( data, function( key, value ) {

                          $(".qcitem_parts_tbl2").append('<tr class="detail_tr"><td>'+value.products.mfr+'</td><td>'+value.products.part_num+'</td> <td>'+value.products.part_name+'</td><td>'+value.products.part_desc+'</td> <td>'+value.qty_qc+'</td> <td>'+value.products.default_um+'</td></tr>');

                        });

                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });

            $("#qc_request .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#qc_request').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-qc-request",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Qc Request Deleted.");
                        $("#qc_request").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
         
            }
        });
    },);


    $(function(){
        $("#qc_outstanding").DataTable( {
            "processing": true,
            "serverSide": true,
            ajax: {
                'url': '/qcRequestoutstanding-dt',
                'type':"post",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[
            {
                data: "id"
            },
            // {
            //     data: "entry_queue_id"
            // },
            {
                 data: function(data){
                    return data.document.reference_rr
                }
            },
            {
                 data: function(data){
                    return data.user.name
                }
            },
            {
                data: "remark"
            },
            {
                data: "created_at"
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Outstanding</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--info m-badge--wide m--font-light">On Progress</span>';
                    }else if(data.status == 2)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Pass QC</span>';
                    }else if(data.status == 3)
                    {
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">QC Rejected</span>';
                    }else if(data.status == 4)
                    {
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">QC Partial Rejected</span>';
                    }

                }
            },
         
            {

                data: function(data){
                    return '<a style="text-decoration: none;" href="#" data-toggle="modal" data-target="#m_modal_1" class="view btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-eye"></i></a> <a href="/edit-qcRequest/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },

       
             ],
            "drawCallback":function(setting){

                $("#qc_outstanding .view").on("click",function(e){
                $(".detail_tr").empty();
                e.preventDefault();
                var input = $('#qc_outstanding').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/qc-request-parts-list/"+input.id,
                    method:"get",
                    success:function(data){

                        $.each( data, function( key, value ) {

                          $(".qcitem_parts_tbl2").append('<tr class="detail_tr"><td>'+value.products.mfr+'</td><td>'+value.products.part_num+'</td> <td>'+value.products.part_name+'</td><td>'+value.products.part_desc+'</td> <td>'+value.qty_qc+'</td> <td>'+value.products.default_um+'</td></tr>');

                        });

                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });

            $("#qc_outstanding .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#qc_outstanding').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-qc-request",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Qc Request Deleted.");
                        $("#qc_outstanding").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
          
            }
        });
    },);
</script>
@endsection
