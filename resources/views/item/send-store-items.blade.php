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
							Send Store Items
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-sendstore-items')}}">
					<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-4">
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Store Request List</label>
									<select class="form-control m-input m-input--square store_item_request_id" name="store_item_request_id" required="true">
									<option>Select Item</option>
									@foreach($storeItemRequest as $itemReq)
										<option value="{{$itemReq->id}}">{{$itemReq->id}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-4">	
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Sender</label>
									<!-- <input type="text" name="sender" class="form-control m-input" required="true"> -->
									<select class="form-control m-input m-input--square" name="sender" required="true">
									<option value="">Select</option>
									@foreach($users as $user)
										<option value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-4">	
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Hand-Over by</label>
									<select class="form-control m-input m-input--square" name="handover_by_id" required="true">
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
								</div>	 -->
						</div>
						<div class="form-group m-form__group table-responsive">
							<table class="table m-table m-table--head-bg-metal new_raw_sendItem m--margin-top-20" id="new_raw_sendItem"> 
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
							<button type="submit" id="btn_send_storeitem" style="display: none;" class="btn btn-primary">Submit</button>
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
	
	var send_val = null;
	$('.store_item_request_id').on('change',function(){
		$(".sendstore-tr").remove();
	$("#btn_send_storeitem").show();
    send_val = $(this).val(); 
	console.log(send_val);
	$.ajax({
        type:"get",
        url: "/sendstore-itemsdata/"+send_val,
        success: function(data) { 
           
        $.each(data, function (index, datum) {
    
            $("#new_raw_sendItem").append('<tr class="sendstore-tr">'+
            	'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.products.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.products.part_num+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.products.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.products.part_desc+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="qty_request[]" value="'+datum.qty_request+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.products.default_um+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'</tr>');

        });
        }
   	    });
	});
});
</script>
@endsection