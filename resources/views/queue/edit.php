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
									<option value="{{$document->document_no}}" data="{{$document->po_id}}" >{{$document->document_no}}</option>
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
						<div class="form-group m-form__group" hidden>
										<label for="exampleInputEmail1">Reference No.</label>
										<input type="text" class="form-control m-input reference_id" name="reference_id" style="border: none;" required="true">
									</div>
						<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Request Status</label>
									<select class="form-control m-input m-input--square" name="status" required="true">
									<option value="">Select</option>
									<option value="5">Outstanding</option>
									<option value="0">Quality Check</option>
									<option value="2">Dispatch to Warehouse</option>
									
									</select>
								</div>
					</div>
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1">Remark</label>
						<textarea rows="5" class="form-control m-input" name="remark" required></textarea>
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
					          <th>Qty Qc</th>
					          <th>U/M</th>
					          <th>Delivered</th>
					        </tr>
					    </thead>
					    <tbody>
					        <!-- <tr>
					          <td><input type="text" name="mfr[]" class="form-control m-input mfr" style="width: 100px;" required="true"></td>
					          <td><input type="text" name="part_name[]" class="form-control m-input part_name" required="true"></td> 
					          <td><input type="text" name="description[]" class="form-control m-input description" required="true"></td>
					          <td><input type="text" name="qty_qc[]" class="form-control m-input qty_po" style="width: 100px;" required="true"></td>
					          <td><input type="text" name="um[]" class="form-control m-input um" style="width: 100px;" required="true"></td>
					          
					        </tr> -->
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
		$(".report-tr").remove();
		var referenceId = $(this).find('option:selected').attr('data');
		var type = $(this).find('option:selected').attr('type');
		$(".reference_id").val(referenceId);

		$.ajax({
	        type:"get",
	        url: "/po-data/"+referenceId,
	        success: function(data) {
	           //console.log(data);
	        $.each(data, function (index, datum) {
	        	console.log(datum);
	          $("#new_raw_qc").append('<tr class="report-tr">'+
	          		'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
	          		'<td>'+datum.products.mfr+'</td>'+
	            	'<td>'+datum.products.part_num+'</td>'+
	            	'<td>'+datum.products.part_name+'</td>'+
	            	'<td>'+datum.products.part_desc+'</td>'+
	            	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_pos+'"  required="true"></td>'+
	            	'<td>'+datum.um_pos+'</td>'+
					'<td><input type="checkbox" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="0"  required="true"></td>'+
	          		'</tr>');
	            // $("#new_raw_report").append('<tr class="report-tr">'+
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
</script>
@endsection



$(function(){
	
	var request_val = null;
	$('.document_no').on('change',function(){
		// $("#btn_qc").show();
		$(".qc-detail").remove();
		$(".queue_id").val('');
		var currenr_val = $(this).val();
		var document_item = <?php echo json_encode($documents); ?>;
		jQuery.each(document_item,function( i, documents){
			if(currenr_val == documents.document_no)
			{
				$(".queue_id").val(documents.queue_id);
				$(".receive_doc_id").val(documents.id);
				
				// request_val = $(this).val();
				
			}
		});
	});
    // $(".btn_add_qc").on("click",function(){
    //     $(".new_qc_raw").append('<tr>'+
    //     	'<td><input type="text" name="mfr[]" class="form-control m-input mfr" style="width: 100px;"></td>'+
    //     	'<td><input type="text" name="part_name[]" class="form-control m-input part_name"></td>'+
    //     	'<td><input type="text" name="description[]" class="form-control m-input description"></td>'+
    //     	'<td><input type="text" name="qty_qc[]" class="form-control m-input qty_qc" style="width: 100px;"></td>'+
    //     	'<td><input type="text" name="um[]" class="form-control m-input um" style="width: 100px;"></td>'+
    //     	'</tr>');
    // });
   	
		$(".document_no").on("change",function(){
		$('.reference_id').val('');
		$(".report-tr").remove();
		var referenceId = $(this).find('option:selected').attr('data');
		var type = $(this).find('option:selected').attr('type');
		$(".reference_id").val(referenceId);

		$.ajax({
	        type:"get",
	        url: "/po-data/"+referenceId,
	        success: function(data) {
	           //console.log(data);
	        $.each(data, function (index, datum) {
	        	console.log(datum);
	          $("#new_raw_qc").append('<tr class="report-tr">'+
	          		'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
	          		'<td>'+datum.products.mfr+'</td>'+
	            	'<td>'+datum.products.part_num+'</td>'+
	            	'<td>'+datum.products.part_name+'</td>'+
	            	'<td>'+datum.products.part_desc+'</td>'+
	            	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_pos+'"  required="true"></td>'+
	            	'<td>'+datum.um_pos+'</td>'+
					'<td><input type="checkbox" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="0"  required="true"></td>'+
	          		'</tr>');
	            // $("#new_raw_report").append('<tr class="report-tr">'+
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