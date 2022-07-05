@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">

          <!-- BEGIN: Subheader -->
          <div class="m-subheader ">
            <div class="d-flex align-items-center">
              <div class="mr-auto">
                <h3 class="m-subheader__title ">Storing Dashboard</h3>
                <div class="row">

            <!-- Earnings (Monthly) Card Example -->

            <div class="col-xl-3 col-md-6 mb-4">
           
           <div class="card border-left-primary shadow h-100 py-2">
             <div class="card-body"> 
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Receive Item &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">{{$countReceive}}</div></span></div>
                   <a href="{{url('/receive-document')}}">
                   <img src="{{url('/image/mover2.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <a href="{{url('/receive-itemwh-list')}}" class="btn btn-primary stretched-link">View</a>
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
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Store Item &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">{{$countStore}}</div></span></div>
                      <a href="{{url('/receive-document')}}">
                      <img src="{{url('/image/storeout.png')}}" width="30%"  class="center">
                      </a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/store-item')}}" class="btn btn-primary stretched-link">View</a>
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
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Internal Storing &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">13</div></span></div>
                   <a href="#">
                   <img src="{{url('/image/storing2.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/storeitem-request')}}" class="btn btn-primary stretched-link">View</a>
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
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Transfer Item &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">{{$countTransfer}}</div></span></div>
                   <a href="{{url('/receive-document')}}">
                   <img src="{{url('/image/transfer.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <a href="{{url('/transfer-item-list')}}" class="btn btn-primary stretched-link">View</a>
                 </div>
                 <div class="col-auto">
               
                 </div>
               </div>
             </div>
           </div>
       
         </div>
       
       

        <!-- Content Row -->

        

<!-- Area Chart -->


    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold text-info">Inventory need to fix</h4>
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
    <!-- Card Body -->
    <div class="card-body">
      <div class="chart-area">
      <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data">
                    <table class="table table-striped- table-bordered table-hover table-checkable" style="color: red;" id="receiveitems_wh">
                        <thead>
                            <tr>
                              
                                <!-- <th>Sender</th> -->
                                <!-- <th>Receiver</th> -->
                                <th>MFR</th>
                                <th>Part#</th>
                                <th>Part Name</th>
                                <th>Problem QTY</th>
                
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="modal fade " id="m_modal_receiveitem_wh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <table class="table table-bordered m-table receiveitems_wh"> 
                        <tr>
                          <th>Id</th>
                          <th class="first">Mfr.</th>
                          <th>Product Number</th>
                          <th class="second">Part Name</th>
                          <th class="third">Description</th>
                          <th class="fourth">Qty Receive</th>
                          <th class="fifth">U/M</th> 
                          <!-- <th>Warehouse</th>
                          <th>Location</th> -->
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
        <canvas id="myAreaChart">
            
        </canvas>
      </div>
    </div>



<!-- Pie Chart -->



  <!-- Color System -->


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

<script type="text/javascript">
$(function(){
        $("#receiveitems_wh").DataTable( {
            "processing": true,
            "serverSide": true,
            ajax: {
                'url': '/prob-inv-list',
                'type':"get",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[ 
      
            {
                data: function(data){
                   return data.inventory.products.mfr
                }
            },
            {
                data: function(data){
                   return data.inventory.products.part_num
                }
            },
            {
                data: function(data){
                   return data.inventory.products.part_name
                }
            },
          
            {
              data: "qty_seen"
            },
            {
              
                data: function(data){
                  if(data.inventory.warehouse.wh_name == null){
                    return data.inventory.warehouse.warehouse.name
                  }else{
                    return data.inventory.warehouse.warehouse.name+' '+data.inventory.warehouse.wh_name
                  }
                  
                }
            },
            {
                
                data: function(data){
                    return '<a href="/prob-inv-update/'+data.id+'" style="text-decoration: none;" class="btn btn-outline-brand">Already Fixed</a> ';
                }
            },
         
             ],
            "drawCallback":function(setting){

            $("#receiveitems_wh .view").on("click",function(e){
                $(".receiveitems_detail_tr").empty();
                e.preventDefault();
                var input = $('#receiveitems_wh').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/receive-itemwh-detail/"+input.id,
                    method:"get",
                    success:function(data){
                       
                        $.each( data, function( key, value ) {
                          
                          $(".receiveitems_wh").append('<tr class="receiveitems_detail_tr"><td>'+value.products.id+'</td><td>'+value.products.mfr+'</td><td>'+value.products.part_num+'</td> <td>'+value.products.part_name+'</td><td>'+value.products.part_desc+'</td> <td>'+value.qty_receive +'</td> <td>'+value.products.default_um+'</tr>');
                            
                        });
                        
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });

            $("#receiveitems_wh .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#receiveitems_wh').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-receiveitem-wh",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Receive Items In Warehouse Deleted.");
                        $("#receiveitems_wh").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            // $("#receiveitems_wh .edit").on("click",function(e){
            //     e.preventDefault();
            //     var input = $('#receiveitems_wh').DataTable().row($(this).parents('tr')).data();
            //     $.ajax({
            //         url:"/edit-qcRequest",
            //         method:"post",
            //         data:{'id':input.id,'_token':$("#token").val()},
            //         success:function(data){
            //             alert("Successfully Change Status.");
            //             $("#receiveitems_wh").DataTable().draw();
            //         },
            //         error:function(data){
            //             alert("There is some internal error");
            //         }
            //     });
            // });
            // </td> <td class="warehouse_send_item"></td>'+
            //                 '<td class="location_send_item"></td>
                            // var warehouses_array = 
            //             jQuery.each(warehouses_array,function( i, warehouse){
            //               if(value.warehouse == warehouse.id)
            //               {
            //                 $(".warehouse_send_item").text(warehouse.name);
                            
            //                 jQuery.each(warehouse.warehouse_location,function( i, location){
            //                     if(value.location_rack == location.id){
            //                         $(".location_send_item").text(location.location);
            //                     }
            //                 });
            //               }
            //             });
            }
        });
    });

</script>
@endsection