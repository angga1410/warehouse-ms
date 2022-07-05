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
							Add New Serial Number
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<form method="post" action="{{url('/add-report-serialno')}}" id="qcrequest_srno">
					<div class="row">
					<div class="col-sm-12">
					  <div class="row">
						<div class="col-sm-6">
							{!! csrf_field() !!}
							<input type="hidden" name="qc_request_id" class="entry_queue_id">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Document Number</label>
								<select class="form-control m-input m-input--square document_no" name="document_no" required>
								<option value="">Select Document Number</option>
								@foreach ($serialnoDetails as $key => $serialnoDetail)
									<option value="{{$serialnoDetail['document_no']}}" data="{{$serialnoDetail['id']}}">{{$serialnoDetail['document_no']}}</option>
								@endforeach
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Part Number</label>
								<select class="form-control m-input m-input--square product_number" name="product_number" required="true">

								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Qty Qc</label>
								<input type="number" style="border:none;" class="form-control m-input qty_qc" name="qty_qc" required="true" readonly>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Part Name</label>
								<input type="text" style="border:none;" class="form-control m-input part_name" name="part_name" required="true" readonly>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">U/M</label>
								<input type="text" style="border:none;" class="form-control m-input um" name="um" required="true" readonly>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Description</label>
								<textarea rows="5" class="form-control m-input description" name="description" style="border:none;" required="true" readonly></textarea>
							</div>
						</div>
					   </div>
						<div class="form-group m-form__group text-center">
							<button type="button" name="btn_add_sn" class="btn_add_sn btn m-btn--pill btn-warning pull-right" style="width:150px; color:white;">Add More Serial No.</button>
						</div>
						<div class="form-group m-form__group table-responsive">
							<table class="table m-table m-table--head-bg-metal new_sn_raw m--margin-top-20">
							<thead>
						        <tr>
						          <th class="first">Serial No.</th>
						        </tr>
						    </thead>
						    <tbody>
						        <tr>
						          <td><input type="text" name="serial_no[]" class="form-control m-input serial_no" required="true"></td>
						        </tr>
						    </tbody>
						   	</table>
						</div>
						<input type="hidden" name="part_id" class="part_id">
						<div class="form-group m-form__group text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
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
		var responce = null;

	    $(".btn_add_sn").on("click",function(){
	        $(".new_sn_raw").append('<tr><td><input type="text" name="serial_no[]" class="form-control m-input serial_no" required></td></tr>');
	    });
	    $(".document_no").on('change',function(){
	    	$(".product_number").empty().append('<option value="">Select Product Number</option>');
	    	$(".part_name").val('');
	    	$(".qty_qc").val('');
	    	$(".um").val('');
	    	$(".description").val('');

	    	var e_queue_id = $(this).find('option:selected').attr('data');
	    	$(".entry_queue_id").val(e_queue_id);
			$.ajax({
				type:"get",
				url: "/serialno-parts/"+e_queue_id,
				success: function(data) {
					responce = data;
			        $.each(data, function (index, optiondata) {
			            $(".product_number").append("<option value='" + optiondata.products.product_number + "'data='"+ optiondata.id +"'>" + optiondata.products.product_number +"</option>");
			        });

				}
			});
	    });
	    $(".product_number").on('change',function(){
	    	var currentId = $(this).val();
	    	var partId = $(this).find('option:selected').attr('data');
	    	$(".part_id").val(partId);
	    	$(".part_name").val('');
	    	$(".qty_qc").val('');
	    	$(".um").val('');
	    	$(".description").val('');
	    	$.each(responce, function (index, optiondata) {
	    		if(currentId == optiondata.products.product_number)
	    		{
	    			$(".qty_qc").val(optiondata.qty_qc);
	    			$(".part_name").val(optiondata.products.part_name);
			    	$(".um").val(optiondata.products.um);
			    	$(".description").val(optiondata.products.description);
	    		}
	    	});


	    })

});
</script>
@endsection
