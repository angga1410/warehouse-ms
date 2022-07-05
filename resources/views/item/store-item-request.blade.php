@extends('layout.admin.base')
@section('style')
<style type="text/css">
	.dataRow input{
		border: none!important;
	}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Store Item Request
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-store-item-req')}}">
					<div class="row">
						<div class="col-sm-12">
							{!! csrf_field() !!}
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference No.</label>
										<select class="form-control m-input m-input--square reference_no" name="reference_id" required="true">
										<option>select Reference</option>
										@foreach($receiveItemFromWh as $receive_item)
											<option value="{{$receive_item->id}}">{{$receive_item->id}}</option>
										@endforeach
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source</label>
										<select class="form-control m-input m-input--square" name="source" required="true">
										<option value="external">External</option>
										<option value="internal">Internal</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Type</label>
										<select class="form-control m-input m-input--square" name="source_type" required="true">
										<option value="supplier">Supplier</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference Type</label>
										<select class="form-control m-input m-input--square" name="reference_type" required="true">
										<option value="internal">Internal</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">source Name</label>
										<input type="text" class="form-control m-input" name="source_name" required="true">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Requester</label>
										<select class="form-control m-input m-input--square" name="requester_id" required="true">
										<option>Select Requester</option>
										@foreach($users as $user)
											<option value="{{$user->id}}">{{$user->name}}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>
							
						
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw_storeItemReq m--margin-top-20" id="new_raw_storeItemReq"> 
						<thead>
					        <tr>
					          <th>Mfr.</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Request</th>
					          <th>U/M</th>
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit" id="btn_storeitem_request" style="display: none;" class="btn btn-primary">Submit</button>
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
   
 var store_val = null;
	$('.reference_no').on('change',function(){
		$(".storereq-tr").remove();
		$("#btn_storeitem_request").show();
    store_val = $(this).val(); 
	console.log(store_val);
	$.ajax({
        type:"get",
        url: "/store-item-reqdata/"+store_val,
        success: function(data) { 
           console.log(data);
        $.each(data, function (index, datum) {
    
            $("#new_raw_storeItemReq").append('<tr class="storereq-tr">'+
            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.description+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="qty_request[]" value="'+datum.qty_receive+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.um+'" style="width:75px;border:none;"></td>'+
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