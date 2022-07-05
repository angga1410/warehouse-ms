@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="warehouseList">
@include('flash::message')
    <div class="m-subheader ">
    <div class="row">
    <a href="{{url('/new-warehouse')}}" class="btn btn-primary stretched-link">Add New</a>
<!-- Earnings (Monthly) Card Example -->
<!-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Warehouse</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">00 Location</div>
          <br></br>
          <a href="{{url('/new-warehouse')}}" class="btn btn-primary stretched-link">Add New</a>
        </div>
        <div class="col-auto">
      
          <img alt="" src="{{url('/image/w2.png')}}"width="90" height="90"/>
        
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Warehouse Zoning</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">00 Zone</div>
          <br></br>
          <a href="{{url('/warehouse-location-list')}}" class="btn btn-primary stretched-link">View</a>
        </div>
        <div class="col-auto">
          <a href="">
        <img  alt="" src="{{url('/image/wlocation.png')}}"width="90" height="90"/>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Warehouse Racking</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">00 Rack</div>
          <br></br>
          <a href="{{url('/warehouse-racking-list')}}" class="btn btn-primary stretched-link">View</a>
        </div>
        <div class="col-auto">
        <img alt="" src="{{url('/image/racking.png')}}"width="90" height="90"/>
        </div>
      </div>
    </div>
  </div>
</div> -->
    </div>
        <div class="d-flex align-items-center">
            
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Warehouse List</h3>
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
             
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="warehouse_list">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
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
        $("#warehouse_list").DataTable( {
            "processing": true,
            "serverSide": true,
            ajax: {
                'url':"/warehouse-list-dt", 
                'type':"post", 
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[ {
                data: "id"
            }
            , {
                data: "name"
            }
            , {
                data: function(data){
                    return '<a href="/warehouse/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            }
            ], 
            // columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
            // ],
            "drawCallback":function(setting){

                $("#warehouse_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#warehouse_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-warehouse",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Warehouse Deleted.");
                        $("#warehouse_list").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            }
        });
    });
</script>
@endsection
