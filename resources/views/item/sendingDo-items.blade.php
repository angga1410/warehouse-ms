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
							Sending Do Items 
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-sendingDo')}}">
					<div class="row">
						
						<div class="col-sm-12">
							{!! csrf_field() !!}
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Refference Item List</label>
										<select class="form-control m-input m-input--square packing_item_id" name="packing_item_id" required="true">
										<option value="">Select Item</option>
										@foreach($packingItems as $packingItem)
											<option value="{{$packingItem->id}}">{{$packingItem->id}}</option>
										@endforeach
										</select>
									</div>

									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Do</label>
										<select class="form-control m-input m-input--square" name="do_id" required="true">
										<option value="">Select</option>
										@foreach($users as $user)
											<option value="{{$user->id}}">{{$user->name}}</option>
										@endforeach
										</select>
									</div>  

									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Pack By</label>
										<select class="form-control m-input m-input--square" name="handover_by_id" required="true">
										<option value="">Select</option>
										@foreach($users as $user)
											<option value="{{$user->id}}">{{$user->name}}</option>
										@endforeach
										</select>
									</div> 
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Pickup Date</label>
										<input type="text" class="form-control" id="m_datetimepicker_1" placeholder="Select date & time" name="pickup_date" value="" required="true" />
									</div>  
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Send Via</label>
										<select class="form-control m-input m-input--square" name="send_via" required="true">
										<option value="">Select</option>
										<option value="driver">Driver</option>
										<option value="installer">Installer</option>
										<option value="crc">Crc</option>
										<option value="forwarder">Forwarder</option>
										<option value="pickupbyuser">PickUp By Customer</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">sender</label>
										<!-- <input type="text" class="form-control m-input" name="sender" required="true"> -->
										<select class="form-control m-input m-input--square" name="sender_id" required="true">
											<option value="">Select Sender</option>
											@foreach($users as $user)
												<option value="{{$user->id}}">{{$user->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Contact</label>
										<input type="text" class="form-control m-input" name="contact" required="true">
									</div>
								</div>
							</div>
						
						<div class="form-group m-form__group table-responsive">
							<table class="table m-table m-table--head-bg-metal new_raw_packing m--margin-top-20" id="new_raw_packing"> 
							<thead>
						        <tr>
						          	<th>Id</th>
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
							<button type="submit" class="btn btn-primary" style="display: none;" id="btn_senddo">Submit</button>
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
	
	var sendDo_val = null;
	$('.packing_item_id').on('change',function(){
		$(".sendDo-tr").remove();
		$("#btn_senddo").show();
    sendDo_val = $(this).val(); 

	$.ajax({
        type:"get",         
        url: "/sendingDodata/"+sendDo_val,
        success: function(data) { 
           
        $.each(data, function (index, datum) {
    
            $("#new_raw_packing").append('<tr class="sendDo-tr">'+
            	'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.products.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.products.part_num+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.products.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.products.part_desc+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="qty_send[]" value="'+datum.qty_pack+'" readonly="true" style="width:75px;border:none;"></td>'+
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