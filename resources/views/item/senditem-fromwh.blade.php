@extends('layout.admin.base')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Send Items From Warehouse
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-senditems-fromwh')}}">
				<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-6">
						
							{!! csrf_field() !!}
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Reference Type</label>
								<select class="form-control m-input m-input--square reference_type" name="reference_type" required="true">
								<option value="">Select Reference Type</option>
								<option value="internal_department">Internal</option>
								<option value="dispatch_order">External</option>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Pick List</label>
								<select class="form-control m-input m-input--square pick_item_id" name="pick_id" required="true">
								<option value="">Select Item</option>
								
								</select>
							</div>
							
						</div>
						<div class="col-sm-6">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Sender</label>
								<select class="form-control m-input m-input--square" name="sender_id" required="true">
								<option value="">Select Sender</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Hand-Over By</label>
								<select class="form-control m-input m-input--square" name="handover_by_id" required="true">
								<option value="">Select Hand-over</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
								</select>
							</div>
							
							<!-- <div class="form-group m-form__group">
								<label for="exampleInputEmail1">Warehouse</label>
								<select class="form-control m-input m-input--square warehouse_select" name="warehouse" required="true">
								<option value="">Select Warehouse</option>
								@foreach($warehouses as $warehouse)
									<option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
								@endforeach
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Location/Rack</label>
								<select class="form-control m-input m-input--square location_select" name="location_rack" required="true">
								
								</select>
							</div> -->
							
						</div>
							<!-- <div class="form-group m-form__group col-sm-6">
					    		<div class="m-typeahead">
									<input class="form-control m-input" id="searchPickItems" type="text" dir="ltr" placeholder="Search Item">
								</div>
							</div>	 -->
						
					</div>
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw_send m--margin-top-20" id="new_raw_send"> 
						<thead>
					        <tr>
					          <th>Product Id</th>
					          <th>Mfr.</th>
					          <th>Pick Item Id</th>
					          <th>Part Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Sent</th>
					          <th>U/M</th>
					          <!-- <th>Pick Warehouse</th> -->
							  <!-- <th>Pick Location</th>
							  <th>Pick Rack</th> -->
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit" id="btn_senditem_fromwh" style="display: none;" class="btn btn-primary">Submit</button>
					</div>	
				</div>
				</div>		
				</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(function(){

	$('.reference_type').on('change',function(){
		$(".sendfromwh-tr").remove();
		$('.pick_item_id').empty().append('<option>Select Item</option>');
		
	var currentVal = $(this).val();
		$.ajax({
        type:"get",
        url: "/sendItems-type/"+currentVal,
        success: function(data) { 
	        $.each(data, function (index, datum) {
	    		$('.pick_item_id').append('<option value="'+datum.id+'">'+datum.id+'</option>');
	        });
        }
      });
	});
	// $('.warehouse_select').on("change",function(){
	// 	$('.location_select').empty();
	// 	var currentVal = $(this).val();
	// 	var warehouse_item = <?php echo json_encode($warehouses); ?>;
	// 	jQuery.each(warehouse_item,function( i, warehouse){
	// 		if(currentVal == warehouse.id){
	// 			jQuery.each(warehouse.warehouse_location,function( i, location){
	// 			$(".location_select").append('<option value="'+location.id+'">'+location.location+'</option>');
	// 			});
	// 		}
    //     });
	// })
	var pick_val = null;
	$('.pick_item_id').on('change',function(){
		$(".sendfromwh-tr").remove();
		$("#btn_senditem_fromwh").show();
	pick_val = $(this).val();
	$.ajax({
        type:"get",
        url: "/sendwh-item-data/"+pick_val,
        success: function(data) { 
        
        $.each(data, function (index, datum) {

			// var warehouse_item = <?php echo json_encode($warehouses); ?>;
        	// console.log(warehouse_item);
	    	// var warhouse_list = "";
	        // $.each(warehouse_item,function( i, warehouse){
	        //     warhouse_list += '@if('+datum.warehouse == warehouse.id+') '+warehouse.name+'@endif';
			// });
			
			// var location_item = <?php echo json_encode($locations); ?>;
        	// console.log(location_item);
	    	// var location_list = "";
	        // $.each(location_item,function( i, location){
	        //     location_list += '@if('+datum.location == location.id+') '+location.zone+'@endif';
			// });
			
			// var rack_item = <?php echo json_encode($racks); ?>;
        	// console.log(rack_item);
	    	// var rack_list = "";
	        // $.each(rack_item,function( i, rack){
	        //     rack_list += '@if('+datum.rack == rack.id+') '+rack.rack+'@endif';
	        // });




            $("#new_raw_send").append('<tr class="sendfromwh-tr">'+
            	'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.products.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="pick_item_id[]" value="'+datum.id+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.products.part_num+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.products.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.products.part_desc+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="qty_sent[]" value="'+datum.qty_picked+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.products.default_um+'" style="width:75px;border:none;"></td>'+
				// '<td><input type="text" class="form-control m-input" name="warehouse[]" value="'+datum.warehouses.id+'" style="width:75px;border:none;"></td>'+
            
            	'</tr>');

        });
        }
   	    });
	});
});
</script>
@endsection