@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">

          <!-- BEGIN: Subheader -->
          <div class="m-subheader ">
            <div class="d-flex align-items-center">
              <div class="mr-auto">
                <h3 class="m-subheader__title ">Packing Dashboard</h3>
                <div class="row">

            <!-- Earnings (Monthly) Card Example -->
         
            <div class="col-xl-3 col-md-6 mb-4">
           
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body"> 
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Receive Items From Warehouse &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">20</div></span></div>
                      <a href="{{url('/receiveitem-fromwh-list')}}">
                      <img src="{{url('/image/packing2.png')}}" width="30%"  class="center">
                      </a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/receiveitem-fromwh-list')}}" class="btn btn-primary stretched-link">View</a>
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
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Packing &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">13</div></span></div>
                   <a href="#">
                   <img src="{{url('/image/packing.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/packing-items-list')}}" class="btn btn-primary stretched-link">View</a>
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
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Sent Items &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">13</div></span></div>
                   <a href="#">
                   <img src="{{url('/image/packing.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/sendingDo-list')}}" class="btn btn-primary stretched-link">View</a>
                 </div>
                 <div class="col-auto">
               
                 </div>
               </div>
             </div>
           </div>
       
         </div>
       
       

        <!-- Content Row -->

        

<!-- Area Chart -->
<div class="col-xl-8 col-lg-7">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold text-info">Dispatch to Loading</h4>
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
                               
                            </tr>
                        </thead>
                    </table>
                </div>
        <canvas id="myAreaChart">
            
        </canvas>
      </div>
    </div>
  </div>
</div>

<!-- Pie Chart -->
<div class="col-xl-4 col-lg-5">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h4 class="m-0 font-weight-bold text-danger">Outstanding Items</h4>
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
      <div class="chart-pie pt-4 pb-2">
      <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="packing_item_list">
                        <thead>
                            <tr>
                              
                                <th>Reference No.</th>
                                <th>Do</th>
                                <th>Pack By</th>
                                <th>packing Date</th>
                               
                            </tr>
                        </thead>
                    </table>
                </div>
        <canvas id="myPieChart"></canvas>
      </div>
    
    </div>
  </div>
</div>


<!-- Content Row -->
<div class="row">

<!-- Content Column -->
<div class="col-lg-6 mb-4">

  <!-- Project Card Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
    </div>
    <div class="card-body">
      <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
      <div class="progress mb-4">
        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
      <div class="progress mb-4">
        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
      <div class="progress mb-4">
        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
      <div class="progress mb-4">
        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
      <div class="progress">
        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>
  </div>

  <!-- Color System -->
  <div class="row">
    <div class="col-lg-6 mb-4">
      <div class="card bg-primary text-white shadow">
        <div class="card-body">
          Primary
          <div class="text-white-50 small">#4e73df</div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card bg-success text-white shadow">
        <div class="card-body">
          Success
          <div class="text-white-50 small">#1cc88a</div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card bg-info text-white shadow">
        <div class="card-body">
          Info
          <div class="text-white-50 small">#36b9cc</div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card bg-warning text-white shadow">
        <div class="card-body">
          Warning
          <div class="text-white-50 small">#f6c23e</div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card bg-danger text-white shadow">
        <div class="card-body">
          Danger
          <div class="text-white-50 small">#e74a3b</div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="card bg-secondary text-white shadow">
        <div class="card-body">
          Secondary
          <div class="text-white-50 small">#858796</div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="col-lg-6 mb-4">

  <!-- Illustrations -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
    </div>
    <div class="card-body">
      <div class="text-center">
        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
      </div>
      <p>   </p>
      
    </div>
  </div>

  <!-- Approach -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
    </div>
    <div class="card-body">
      <p>   </p>
      <p class="mb-0">  </p>
    </div>
  </div>

</div>
</div>

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

    $(function(){
        $("#packing_item_list").DataTable({
            "processing": true,
            "serverSide": true,
             ajax: {
                'url':"/packing-items-dt-dashboard", 
                'type':"post",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[ 
           
            {
                data: "send_items_from_wh_id"
            },
            {
                data: function(data){
                    return data.do_user.name
                }
            },
            {
                data: function(data){
                    return data.pack_by_user.name
                }
            }
            , {
                data: "created_at"
            },
           
             ],
             "drawCallback":function(setting){

                $("#packing_item_list .view").on("click",function(e){
                $(".pack_detail_tr").empty();
                e.preventDefault();
                var input = $('#packing_item_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/pack-data/"+input.id,
                    method:"get",
                    success:function(data){
                       
                        $.each( data, function( key, value ) {
                          
                          $(".pack_item_tbl").append('<tr class="pack_detail_tr"><td>'+value.products.id+'</td><td>'+value.products.mfr+'</td><td>'+value.products.part_num+'</td> <td>'+value.products.part_name+'</td><td>'+value.products.part_desc+'</td> <td>'+value.qty_pack+'</td> <td>'+value.products.default_um+'</td></tr>');
                         
                        });
                        
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
                $("#packing_item_list .edit").on("click",function(e){
                e.preventDefault();
                var input = $('#packing_item_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/edit-packing-items",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Change Status.");
                        $("#packing_item_list").DataTable().draw();
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