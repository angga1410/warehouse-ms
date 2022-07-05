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
							Add New DO Request
						</h3>
					</div>
				</div>
			</div>
	
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-new-material-request')}}">
					<div class="row">
						<!-- <div class="col-sm-1"></div> -->
						<div class="col-sm-12">
							{!! csrf_field() !!}
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group m-form__group" hidden>
										
										<select class="form-control m-input m-input--square" name="reference_type" required="true">
									
										<option value="dispatch_order">Internal</option>
									
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">DO#</label>
										<select class="form-control m-input m-input--square document_no" name="name" required="true">
									
										<option>Select DO</option>
										@foreach ($content as $schedule)
										<option value="{{ $schedule['do_num'] }}{{ $schedule['do_num_seq'] }}" data="{{$schedule['id']}}">{{ $schedule['do_num'] }}{{ $schedule['do_num_seq'] }}</option>
										@endforeach
										</select>
									</div>
									<div class="form-group m-form__group d" id="d" hidden>
									
									</div>
									<div class="form-group m-form__group" hidden>
										<label for="exampleInputEmail1">Reference No.</label>
										<input type="text" class="form-control m-input reference_id" name="receive_document_id" style="border: none;" required="true">
									</div>
									<div class="form-group m-form__group" hidden>
						
										<input type="text" class="form-control m-input reference_id" name="id" style="border: none;" required="true">
									</div>
									<div class="form-group m-form__group" hidden>
										
										<input type="text" class="form-control m-input " value="1" name="status" style="border: none;" required="true">
									</div>

									<input type="hidden" class="form-control m-input" value="0" name="do" style="border: none;" required="true">

									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source</label>
										<select class="form-control m-input m-input--square" name="source" required="true">
										<option value="external">External</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Type</label>
										<select class="form-control m-input m-input--square source_type" name="source_type" required="true">
										<option value="">Select</option>
										<option value="supplier">Supplier</option>
										<option value="customer">Customer</option>
										</select>
									</div>
								
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference</label>
										<select class="form-control m-input m-input--square" name="reference" required="true">
										<option value="internal">Internal</option>
										<option value="external">External</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Requester</label>
										<input class="form-control m-input m-input--square requester_id" name="requester_id"  required="true">
									
									</div>	
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Remark</label>
										<textarea class="form-control m-input m-input--square" name="remark"  required="true"></textarea>
									
									</div>	
									<!-- <div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Name</label>
										<select class="form-control m-input m-input--square source_id" name="source_id" required="true">
											<option value="">Select source</option>
											
										</select>
									</div> -->
								</div>
							</div>
					
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw m--margin-top-20" id="new_raw_qc"> 
						<thead>
					        <tr>
							<th>ID</th>
					          <th>Mfr.</th>
					          <th>Part Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Request</th>
					          <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw m--margin-top-20" id="match_pn"> 
						<thead>
					        <tr>
							<th>ID</th>
					          <th>Mfr.</th>
					          <th>Part Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Request</th>
					          <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit"  class="btn btn-primary" >Submit</button>
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
	
		$(".document_no").on("change",function(){
		$('.reference_id').val('');
		$('.requester_id').val('');
		$(".qc-tr").remove();
		var referenceId = $(this).find('option:selected').attr('data');
		var type = $(this).find('option:selected').attr('type');
		$(".reference_id").val(referenceId);
console.log(referenceId);
		$.ajax({
	        type:"get",
	        url: "/do/"+referenceId,
	        success: function(data) {
	           //console.log(data);
	        $.each(data, function (index, datum) {
	        	// console.log(datum.name);
	          $("#new_raw_qc").append('<tr class="qc-tr">'+
			'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.id+'" readonly="true" style="width:75px;border:none;"></td>'+
	          		'<td>'+datum.mfr+'</td>'+
	            	'<td>'+datum.part_num+'</td>'+
	            	'<td>'+datum.part_name+'</td>'+
	            	'<td>'+datum.part_desc+'</td>'+
	            	'<td><input type="text" name="qty_request[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_mr+'" ></td>'+
					'<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+
	          		'</tr>');
	            // $("#new_raw_qc").append('<tr class="qc-tr">'+
	            // 	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
	            // 	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
	            // 	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.description+'" readonly="true" style="width:75px;border:none;"></td>'+
	            // 	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_qc+'"  required="true"></td>'+
	            // 	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.um+'" style="width:75px;border:none;"></td>'+
	            // 	'</tr>');
	          //   	if(type == 'qc_pass'){
		        	// 	$(".qty"+index).val(datum.qty_qc);
		        	// }else{
		        	// 	console.log(datum.qty_po);
		        	// 	$(".qty"+index).val(datum.qty_po);
		        	// }
	    		});
			}
     	});

		 $.ajax({
	        type:"get",
	        url: "/match-pn/"+referenceId,
	        success: function(data) {
	           //console.log(data);
	        $.each(data, function (index, datum) {
	        	// console.log(datum.name);
	          $("#match_pn").append('<tr class="qc-tr">'+
			'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.id+'" readonly="true" style="width:75px;border:none;"></td>'+
	          		'<td>'+datum.mfr+'</td>'+
	            	'<td>'+datum.part_num+'</td>'+
	            	'<td>'+datum.part_name+'</td>'+
	            	'<td>'+datum.part_desc+'</td>'+
	            	'<td><input type="text" name="qty_request[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_mr+'" ></td>'+
					'<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+
	          		'</tr>');
	            // $("#new_raw_qc").append('<tr class="qc-tr">'+
	            // 	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
	            // 	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
	            // 	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.description+'" readonly="true" style="width:75px;border:none;"></td>'+
	            // 	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_qc+'"  required="true"></td>'+
	            // 	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.um+'" style="width:75px;border:none;"></td>'+
	            // 	'</tr>');
	          //   	if(type == 'qc_pass'){
		        	// 	$(".qty"+index).val(datum.qty_qc);
		        	// }else{
		        	// 	console.log(datum.qty_po);
		        	// 	$(".qty"+index).val(datum.qty_po);
		        	// }
	    		});
			}
     	});
		 $.ajax({
	        type:"get",
	        url: "/mr1/"+referenceId,
	        success: function(data) {
	          
	          $("#d").append(
			'<input type="text" class="form-control m-input" name="createdAt" value="'+data+'" readonly="true" style="width:75px;border:none;">'
	          		);
	    	
			}
     	});

		 $.ajax({
	        type:"get",
	        url: "/get-do/"+referenceId,
	        success: function(data) {
	          
	         console.log(data)
			 $('.requester_id').val(data.requested_by);
			}
     	});
	});
});

$(function () {
  $("select").select2();
});

$('#new_raw_qc').on('click', '.deleteItem', function(){
    $(this).closest ('tr').remove ();
});

</script>
@endsection