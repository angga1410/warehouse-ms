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
							Return Items 
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-qcReturn')}}">
				<div class="row">
				<div class="col-sm-12">
					<div class="row">
						{!! csrf_field() !!}
						<input type="hidden" name="qc_request_id" class="qc_request_id">
						<div class="col-sm-6">
							<!-- <div class="form-group m-form__group">
								<label for="exampleInputEmail1">Qc Request List</label>
								<select class="form-control m-input m-input--square qc_request_id" name="qc_request_id" required="true">
								<option>Select Qc Request</option>
								@foreach($qcRequestItem as $requestItem)
									<option value="{{$requestItem->id}}">{{$requestItem->id}}</option>
								@endforeach
								</select>
							</div> -->
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Document No.</label>
								<select class="form-control m-input m-input--square document_no" name="document_no" required="true">
								<option value="">Select Document Number</option>
								@foreach($qcRequestItem as $requestItem)
									<option data="{{$requestItem->id}}" value="{{$requestItem->document_no}}">{{$requestItem->document_no}}</option>
								@endforeach
								</select>
								<!-- <input type="text" class="form-control m-input document_no" name="document_no" style="border: none;" readonly="true" required="true"> -->
							</div>

							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Supplier</label>
								<select class="form-control m-input m-input--square" name="supplier_id" required="true">
								<option value="">Select</option>
								@foreach($suppliers as $supplier)
									<option value="{{$supplier->id}}">{{$supplier->name}}</option>
								@endforeach
								</select>
							</div>  

							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Mover</label>
								<select class="form-control m-input m-input--square" name="mover_id" required="true">
								<option value="">Select</option>
								@foreach($movers as $mover)
									<option value="{{$mover->id}}">{{$mover->name}}</option>
								@endforeach
								</select>
							</div> 
						</div>
						<div class="col-sm-6">
							
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Supplier Contact</label>
								<input type="text" class="form-control m-input" name="supplier_contact" required="true">
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Remark</label>
								<textarea rows="5" class="form-control m-input" name="remark" required="true"></textarea>
							</div>
						</div>
					</div>
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw_qcreturn m--margin-top-20" id="new_raw_qcreturn"> 
						<thead>
					        <tr>
					          <th>ID</th>
					          <th>Mfr.</th>
					          <th>Product Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Return</th>
					          <th>U/M</th>
					          <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit" class="btn btn-primary" id="btn_return" style="display: none;">Submit</button>
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
	var qcReturn_val = null;
	$('.document_no').on('change',function(){
		var currenr_val = $(this).val();
		// var document_item = <?php echo json_encode($qcRequestItem); ?>;
		// console.log(document_item);
		// jQuery.each(document_item,function( i, documents){
		// 	if(currenr_val == documents.id){
		// 		$(".document_no").val(documents.document_no);
		// 	}
		// });

		$("#btn_return").show();
    qcReturn_val = $(this).find('option:selected').attr('data'); 
    $('.qc_request_id').val(qcReturn_val);
	$.ajax({
        type:"get",         
        url: "/qcReturndata/"+qcReturn_val,
        success: function(data) { 
           
        $.each(data, function (index, datum) {
    
            $("#new_raw_qcreturn").append('<tr>'+
            	'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.products.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.products.part_num+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.products.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.products.part_desc+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="qty_return[]" value="'+datum.qty_qc+'"  style="width:75px;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.products.default_um+'" style="width:75px;border:none;"></td>'+
            	'<td><a class="deleteReturnItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+

            	'</tr>');

        });
        }
   	    });
	});
	$('#new_raw_qcreturn').on('click', '.deleteReturnItem', function(){
    	$(this).closest ('tr').remove ();
	});
});
</script>
@endsection