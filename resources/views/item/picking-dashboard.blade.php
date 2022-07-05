@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">

          <!-- BEGIN: Subheader -->
          <div class="m-subheader ">
            <div class="d-flex align-items-center">
              <div class="mr-auto">
                <h3 class="m-subheader__title ">Picking Dashboard</h3>
                <div class="row">

            <!-- Earnings (Monthly) Card Example -->
         
            <div class="col-xl-3 col-md-6 mb-4">
           
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body"> 
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">MR/DO Request  &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">20</div></span></div>
                      <a href="{{url('/material-request')}}">
                      <img src="{{url('/image/picking.png')}}" width="30%"  class="center">
                      </a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/material-request')}}" class="btn btn-primary stretched-link">View</a>
                    </div>
                    <div class="col-auto">
                  
                    </div>
                  </div>
                </div>
              </div>
          
            </div>
    
            <div class="col-xl-3 col-md-6 mb-4">
           
           <div class="card border-left-primary shadow h-100 py-2">
             <div class="card-body"> 
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Create Document for Pick Items &nbsp;&nbsp;&nbsp;&nbsp; </div>
                   <a href="{{url('/new-doc-request')}}">
                   <img src="{{url('/image/picking.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <a href="{{url('/new-doc-request')}}" class="btn btn-primary stretched-link">View</a>
                 </div>
                 <div class="col-auto">
               
                 </div>
               </div>
             </div>
           </div>
       
         </div>

            <div class="col-xl-3 col-md-6 mb-4">
           
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body"> 
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Picking Item (Cut Stock) &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">20</div></span></div>
                      <a href="{{url('/pick-items-list')}}">
                      <img src="{{url('/image/picking.png')}}" width="30%"  class="center">
                      </a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/pick-items-list')}}" class="btn btn-primary stretched-link">View</a>
                    </div>
                    <div class="col-auto">
                  
                    </div>
                  </div>
                </div>
              </div>
          
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
           
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body"> 
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Send Item From Warehouse &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">20</div></span></div>
                      <a href="{{url('/senditems-fromwh-list')}}">
                      <img src="{{url('/image/picking.png')}}" width="30%"  class="center">
                      </a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/senditems-fromwh-list')}}" class="btn btn-primary stretched-link">View</a>
                    </div>
                    <div class="col-auto">
                  
                    </div>
                  </div>
                </div>
              </div>
          
            </div>
         
       
       

        <!-- Content Row -->

        

<!-- Area Chart -->
<!-- <div class="col-xl-8 col-lg-7">
  <div class="card shadow mb-4">
   
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold text-info">Dispatch to Assembly</h4>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Dropdown Header:</div>
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </div>
    </div>
  
    <div class="card-body">
      <div class="chart-area">
      <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
      <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="material_request">
                        <thead>
                            <tr>
                                <th>Request No.</th>
                                <th>MR Name</th>
                                <th>Source Type</th>
                               
                                <th>Requester</th>
                                <th>MR Date</th>
                                <th>IS Approve</th>
                                <th>Status</th>
                              
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
                </div>
        <canvas id="myAreaChart">
            
        </canvas>
      </div>
    </div>
  </div>
</div> -->

<!-- Pie Chart -->
<!-- <div class="col-xl-4 col-lg-5">
  <div class="card shadow mb-4">
   
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold text-info">Dispatch to Packing</h4>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Dropdown Header:</div>
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </div>
    </div>
  
    <div class="card-body">
      <div class="chart-pie pt-4 pb-2">
      <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
      <table class="table table-striped- table-bordered table-hover table-checkable" id="send_items_from_WH">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pick Id</th>
                                <th>Sender</th>
                                <th>Hand-Over</th>
                               
                                <th>Date</th>
                               
                            </tr>
                        </thead>
                    </table>
                </div>
        <canvas id="myPieChart"></canvas>
      </div>
    
    </div>
  </div>
</div> -->
<div class="modal fade " id="m_modal_send_items_from_WH" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group table-responsive">
                    <table class="table table-bordered m-table send_items_from_WH"> 
                        <tr>
                          <th>Id</th>
                          <th class="first">Mfr.</th>
                          <th>Product Number</th>
                          <th class="second">Part Name</th>
                          <th class="third">Description</th>
                          <th class="fourth">Qty Send</th>
                          <th class="fifth">U/M</th> 
                          <th>Warehouse</th>
                          <th>Location</th>
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

<!-- Content Row -->


</div>
  </div>
</div>
</div>

<!-- END: Subheader -->
<div class="m-content">
</div>
</div>
@endsection 

@section('script')
<script>
  $(function(){
        $("#material_request").DataTable({
            "processing": true,
            "serverSide": true,
             ajax: {
                'url':"/material-request-dt", 
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
              data: "mr_name"
            },
            {
                data: "source_type"
            },
           
            {
              data: "requester_id"
            }
            , {
                data: "created_at"
            },
            {
                data: function(data){
                    if(data.is_approve == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Pending</span>';
                    }else if(data.is_approve == 1)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Approve</span>';
                    }
                    else if(data.is_approve == 2){
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Reject</span>';
                    }
                }
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">processing</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--info m-badge--wide m--font-light">pick</span>';
                    }
                    else if(data.status == 2){
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Sent</span>';
                    }
                    else if(data.status == 3){
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Received</span>';
                    }
                }
            },
        
             ],
            "drawCallback":function(setting){
                $("#material_request .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#material_request').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-mr",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        
                        alert("Successfully User Deleted.");
                        $("#material_request").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
         }
        })
    });

    $(function(){
        $("#send_items_from_WH").DataTable( {
            "processing": true,
            "serverSide": true,
            ajax: {
                'url': '/senditems-fromwh-list-dt',
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
                data: "pick_item_id"
            },
            {
                 data: function(data){
                    return data.sender.name;
                }
            },
            {
                 data: function(data){
                    return data.handover.name;
                }
            },
         
        
         
            {
                data: "created_at"
            },
         
            // {
            //     data: function(data){
            //         if(data.is_verified == 0)
            //         {
            //            return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Pending</span>';
            //         }else if(data.is_verified == 1)
            //         {
            //            return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Approve</span>';
            //         }else if(data.is_verified == 2){
            //              return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Reject</span>';
            //         }
                    
            //     }
            // },
         
    
            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
             ],
            "drawCallback":function(setting){

            $("#send_items_from_WH .view").on("click",function(e){
                $(".senditems_fromwh_detail_tr").empty();
                e.preventDefault();
                var input = $('#send_items_from_WH').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/senditems-fromwh-detail/"+input.pick_item_id,
                    method:"get",
                    success:function(data){
                       
                        $.each( data, function( key, value ) {
                          
                          $(".send_items_from_WH").append('<tr class="senditems_fromwh_detail_tr"><td>'+value.products.id+'</td><td>'+value.products.mfr+'</td><td>'+value.products.part_num+'</td> <td>'+value.products.part_name+'</td><td>'+value.products.part_desc+'</td> <td>'+value.qty_picked +'</td> <td>'+value.products.default_um+'</td> <td class="warehouse_send_item"></td>'+
                            '<td class="location_send_item"></td></tr>');
                            var warehouses_array = <?php echo json_encode($warehouses); ?>;
                        jQuery.each(warehouses_array,function( i, warehouse){
                          if(value.warehouse == warehouse.id)
                          {
                            $(".warehouse_send_item").text(warehouse.name);
                            
                            jQuery.each(warehouse.warehouse_location,function( i, location){
                                if(value.location_rack == location.id){
                                    $(".location_send_item").text(location.location);
                                }
                            });
                          }
                        });
                        });
                        
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });

            $("#send_items_from_WH .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#send_items_from_WH').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-senditems-fromwh",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Send Items From WH Deleted.");
                        $("#send_items_from_WH").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            // $("#send_items_from_WH .edit").on("click",function(e){
            //     e.preventDefault();
            //     var input = $('#send_items_from_WH').DataTable().row($(this).parents('tr')).data();
            //     $.ajax({
            //         url:"/edit-qcRequest",
            //         method:"post",
            //         data:{'id':input.id,'_token':$("#token").val()},
            //         success:function(data){
            //             alert("Successfully Change Status.");
            //             $("#send_items_from_WH").DataTable().draw();
            //         },
            //         error:function(data){
            //             alert("There is some internal error");
            //         }
            //     });
            // });
            }
        });
    });
</script>
@endsection