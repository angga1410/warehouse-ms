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
							Inspection Document
						</h3>
					</div>
				</div>
			</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-new-qc-request')}}" id="qc_request_form">
				<div class="row">
				    <div class="col-sm-12">
				      <div class="row">
						<div class="col-sm-4">
							{!! csrf_field() !!}
							<input type="hidden" name="receive_doc_id" class="receive_doc_id">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Document No.</label>
								<select class="form-control m-input m-input--square document_no" name="document_no" required>
								<option value="">Select Document</option>
								@foreach($documents as $document)
								@if($document->partial_status == 4)
									<option value="{{$document->id}}" data="{{$document->po_id}}" >{{$document->reference_rr}}</option>
									@elseif($document->partial_status == 0)
									<option value="{{$document->id}}" data="{{$document->po_id}}" >{{$document->reference_rr}} (All)</option>
									@elseif($document->partial_status == 2)
									<option value="{{$document->id}}" data="{{$document->po_id}}" >{{$document->reference_rr}} (Partial)</option>
									@endif
								@endforeach
								</select>
							</div>
						</div>
						<!-- <div class="col-sm-4">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Queue</label>
								@foreach($documents as $document)
								<input type="text" class="form-control m-input queue_id" value="{{$document->id}} name="entry_queue_id" readonly="true" style="border: none;" required>
								@endforeach
							</div>
						</div> -->
							<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference DO</label>
										<input type="text" class="form-control m-input" name="reference_do" >
									</div>
						<div class="form-group m-form__group" hidden>
										<label for="exampleInputEmail1">Reference No.</label>
										<input type="text" class="form-control m-input reference_id" name="receive_document_id" style="border: none;" required="true">
									</div>
						<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Request Status</label>
									<select class="form-control m-input m-input--square" name="status" required="true">
									<option value="">Select</option>
								
									<option value="0">Quality Check</option>
									<option value="2">Pass QC</option>
									
									</select>
								</div>
							
					</div>
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1">Remark</label>
						<textarea rows="5" class="form-control m-input remark" name="remark" required></textarea>
					</div>
					<!-- <div class="form-group m-form__group">
						<label for="exampleInputEmail1">Search Items</label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" id="searchProduct" type="text" dir="ltr" placeholder="Search Product">
						</div>
					</div> -->
					  
					<!-- <div class="form-group m-form__group text-center">
						<button type="button" name="btn_add_qc" class="btn_add_qc btn m-btn--pill  btn-warning pull-right" style="width:150px; color:white;">Add New Part</button>
					</div> -->
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw_qc m--margin-top-20" id="new_raw_qc">
						<thead>
					        <tr>
					          <th>Product Id</th>
					          <th>Mfr.</th>
					          <th>Product Number</th>
					          <th>Part Name</th>
							  <th>Description</th>
							  <th>Qty PO</th>
							
					          <th>Qty Delivered</th>
					          <th>U/M</th>
					          <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					       
					    </tbody>
				        </table>
					</div>

					<div class="form-group m-form__group text-center">
						<button type="submit" class="btn btn-primary btn_qc" id="btn_qc"
						>Submit</button>
					</div>
					</form>
				</div>
				</div>		
				

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
		$(".qc-tr").remove();
		var referenceId = $(this).find('option:selected').attr('data');
		var document_id = $(this).find('option:selected').attr('value');
		var type = $(this).find('option:selected').attr('type');
		$(".reference_id").val(referenceId);
		console.log("document_no",document_id);
		console.log("receive_document_id",referenceId);

		
		$.ajax({
        type:"get",
        url: "get-remark/"+document_id,
        success: function(data2) { 
			
			console.log("remark",data2);
			$.each(data2, function () {
				$(".remark").val(data2.remark);


	        });
        
        }
      });

		$.ajax({
	        type:"get",
	        url: "/po-data/"+referenceId,
	        success: function(data) {
	           //console.log(data);
	        $.each(data, function (index, datum) {
	        	console.log(datum);
	          $("#new_raw_qc").append('<tr class="qc-tr">'+
			  '<input type="hidden" name="qty_balance[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_pos+'" >'+
			  '<input type="hidden" name="po_detail_id[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.id+'" >'+
	          		'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
	          		'<td>'+datum.products.mfr+'</td>'+
	            	'<td>'+datum.products.part_num+'</td>'+
	            	'<td>'+datum.products.part_name+'</td>'+
	            	'<td>'+datum.products.part_desc+'</td>'+
	            	'<td>'+datum.qty_pos+'</td>'+
				
					'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_delivered+'" ></td>'+
	            	
					'<td>'+datum.um_pos+'</td>'+
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
