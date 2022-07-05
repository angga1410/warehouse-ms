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
							Receive Items From Warehouse
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-receiveitems-fromwh')}}">
				<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-6">
							{!! csrf_field() !!}
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Reference Type</label>
								<select class="form-control m-select2 reference_type" style="opacity: 1" name="reference_type" required="true">
								<option value="">Select Reference Type</option>
								<option value="internal_department">Internal</option>
								<option value="dispatch_order">Dispatch Order</option>
								</select> 
							</div>

							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Refference Item List</label>
								<select class="form-control m-select2 send_item_id" style="opacity: 1" name="send_id" required="true">
								<option value="">Select Item</option>
								
								</select>
							</div>
						</div>
						<div class="col-sm-6">	
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Sender</label>
								<!-- <input type="text" name="sender" class="form-control m-input" required="true"> -->
								<select class="form-control m-select2" style="opacity: 1" name="sender" required="true">
								<option value="">Select</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Received By</label>
								<select class="form-control m-select2" style="opacity: 1" name="received_by_id" required="true">
								<option value="">Select</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
								</select>
							</div> 
						</div> 
							<!-- <div class="form-group m-form__group col-sm-6">
					    		<div class="m-typeahead">
									<input class="form-control m-input" id="searchPickItems" type="text" dir="ltr" placeholder="Search Item">
								</div>
							</div>  -->	
					</div>
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw_receive m--margin-top-20" id="new_raw_receive"> 
						<thead>
					        <tr>
					          <th>ID</th>
					          <th>Mfr.</th>
					          <th>Part Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Sent</th>
					          <th>U/M</th>
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit" id="btn_receiveitem_fromwh" style="display: none;" class="btn btn-primary">Submit</button>
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
		$(".receivefromwh-tr").remove();
		$('.send_item_id').empty().append('<option>Select Item</option>');
	var currentVal = $(this).val();
		$.ajax({
        type:"get",
        url: "/receiveItems-type/"+currentVal,
        success: function(data) { 
           console.log(data);
	        $.each(data, function (index, datum) {
	    		$('.send_item_id').append('<option data="'+datum.pick_item_id+'" value="'+datum.id+'">'+datum.id+'</option>');
	        });
        }
      });
	});


	var pick_val = null;
	$('.send_item_id').on('change',function(){
		$(".receivefromwh-tr").remove();
		$("#btn_receiveitem_fromwh").show();
    pick_val = $(this).find('option:selected').attr('data'); 
	console.log(pick_val);
	$.ajax({
        type:"get",         
        url: "/receivewh-item-data/"+pick_val,
        success: function(data) { 
           
        $.each(data, function (index, datum) {
    
            $("#new_raw_receive").append('<tr class="receivefromwh-tr">'+
            	'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.products.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.products.part_num+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.products.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.products.part_desc+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="qty_receive[]" value="'+datum.qty_picked+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.products.default_um+'" style="width:75px;border:none;"></td>'+
            	'<input type="hidden" value="'+datum.warehouse+'" name="warehouse[]">'+
                '<input type="hidden" value="'+datum.location_rack+'" name="location_rack[]">'+
            	'</tr>');

        });
        }
   	    });
	});
});
</script>
@endsection