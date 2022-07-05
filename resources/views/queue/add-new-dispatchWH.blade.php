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
							Add New Dispatch to Warehouse Request
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
									<option value="{{$document->document_no}}">{{$document->document_no}}</option>
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
						<div class="col-sm-4">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">QC By</label>
								<select class="form-control m-input m-input--square" name="qc_by" required>
								<option value="">Select</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1">Remark</label>
						<textarea rows="5" class="form-control m-input" name="remark" required></textarea>
					</div>
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1">Search Items</label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" id="searchProduct" type="text" dir="ltr" placeholder="Search Product">
						</div>
					</div>
					  
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
					          <th>Action</th>
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
						<button type="submit" style="display: none;" class="btn btn-primary btn_qc" id="btn_qc"
						>Submit</button>
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
    $('#new_raw_qc').on('click', '.deleteItem', function(){
    $(this).closest ('tr').remove ();
});
});
</script>
@endsection