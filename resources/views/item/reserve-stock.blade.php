@extends('layout.admin.base')
@section('stylesheet')


@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="inventory">
@include('flash::message')
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">Reserve Stock List</h3>
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
                <a href="{{url('/add-reserve-stock')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
					<span>
						<i class="la la-cart-plus"></i>
						<span>New Reserve</span>
					</span>
				</a>
			</div>
			<input type="hidden" id="token" value="{{csrf_token()}}">
			<div class="m-portlet__body">
				<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
					<table class="table table-striped- table-bordered table-hover table-checkable" id="inventory_list">
						<thead>
							<tr>
								<th>Id</th>
								<th>Mfr</th>
                                <th>Part Number</th>
								<th>Part Name</th>
								<th>Description</th>
                                <th>Qty</th>
								<th>warehouse</th>
                                <th>Location</th>
                                <!-- <th>Rack</th> -->
                                <!-- <th>Action</th> -->
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
		$("#inventory_list").DataTable({
			"processing": true,
        	"serverSide": true,
            "ajax": {
                "url":"/inventory-dt",
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
                    return data.products.mfr
                }
            },
            {
                data: function(data){
                    return data.products.part_num
                }
            },
            {
                data: function(data){
                    return data.products.part_name
                }
            },
            {
                data: function(data){
                    return data.products.part_desc
                }
            },
          
            {
                data: "qty"
            },
            {
                data: function(data){
                    return data.warehouse.warehouse.name
                }
            },
            {
                data: function(data){
                    return data.warehouse.zone_id +'.'+ data.warehouse.rack_id +'.'+ data.warehouse.level_id +'.'+ data.warehouse.bin_id
                }
            },
            // {
            //    data: function(data){
            //         return data.location.zone
            //     }
            // },
            // {
            //    data: function(data){
            //         return data.rack.rack
            //     }
            // },
            // {
            //    data: function(data){
            //         return '<a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
            //     }
            // },
             ],
            "drawCallback":function(setting){
                $("#inventory_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#inventory_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-inventory",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        
                        alert("Successfully Inventory Deleted.");
                        $("#inventory_list").DataTable().draw();
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
