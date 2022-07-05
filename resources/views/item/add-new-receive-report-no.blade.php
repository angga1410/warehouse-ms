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
							Add New Report
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-new-report')}}">
					<div class="row">

						<div class="col-sm-12">
							{!! csrf_field() !!}

							<div class="row">
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Document No.</label>
										<select class="form-control m-input m-input--square document_no" name="document_no" required="true">
										<option value="">Select Document</option>
										 @foreach($qcpassData as $qcpass)
										 	<option value="{{$qcpass->document_no}}" data="{{$qcpass->id}}">{{$qcpass->document_no}}</option>
										 @endforeach
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference Type</label>
										<select class="form-control m-input m-input--square reference_type" name="reference_type" required="true">
										<option value="">Select Type</option>
										<option value="external">External</option>
										<option value="internal">Internal</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source</label>
										<select class="form-control m-input m-input--square" name="source" required="true">
										<option value="external">External</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Type</label>
										<select class="form-control m-input m-input--square source_type" name="source_type" required="true">
										<option value="">Select Type</option>
										<option value="supplier">Supplier</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Sender</label>
										<input type="text" class="form-control m-input" name="sender" required="true">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference No.</label>
										<input type="text" class="form-control m-input reference_id" name="reference_id" style="border: none;" required="true">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">source Name</label>
										<!-- <input type="text" class="form-control m-input" name="source_name" required="true"> -->
										<select class="form-control m-input m-input--square source_name" name="source_id" required="true">
										<option value="">select</option>
									</select>
									</div>

									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Mover</label>
										<select class="form-control m-input m-input--square" name="mover_id" required="true">
										<option value="">Select mover</option>
										@foreach($movers as $mover)
											<option value="{{$mover->id}}">{{$mover->name}}</option>
										@endforeach
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Sender Phone</label>
										<input type="text" class="form-control m-input" name="sender_phone" required="true">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Remark</label>
										<textarea rows="5" class="form-control m-input" name="remark" required="true"></textarea>
									</div>
								</div>
							</div>


					<!-- <div class="form-group m-form__group text-center">
						<button type="button" name="btn_addReport" class="btn_addReport btn m-btn--pill  btn-warning pull-right" style="height:40px;width:150px; color:white;">Add Report Detail</button>
					</div> -->
							<div class="form-group m-form__group table-responsive">
								<table class="table m-table m-table--head-bg-metal new_raw_report m--margin-top-20" id="new_raw_report">
								<thead>
							        <tr>
							          <th>Id</th>
							          <th class="first">Mfr.</th>
							          <th class="second">Part Number</th>
							          <th class="second">Part Name</th>
							          <th class="third">Description</th>
							          <th class="seventh">Qty Receive</th>
							          <th class="eighth">U/M</th>
							        </tr>
							    </thead>
							    <tbody>
							        <!-- <tr>
							          <td><input type="text" name="mfr[]" class="form-control m-input mfr" style="width: 100px;" required="true"></td>
							          <td><input type="text" name="part_name[]" class="form-control m-input part_name" required="true"></td>
							          <td><input type="text" name="description[]" class="form-control m-input description" required="true"></td>
							          <td><input type="number" name="qty_receive[]" class="form-control m-input qty_receive" style="width: 100px;" required="true"></td>
							          <td><input type="text" name="um[]" class="form-control m-input um" style="width: 100px;" required="true"></td>
							        </tr> -->
							    </tbody>
						        </table>
							</div>
							<div class="form-group m-form__group text-center">
								<button type="submit" class="btn btn-primary">Save</button>
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

	// $('.reference_type').on('change',function(){
	// 	$(".report-tr").remove();
	// 	$('.document_no').empty().append('<option>Select Document</option>');
	// 	$('.reference_id').val('');
	// var currentVal = $(this).val();
	// 	$.ajax({
 //        type:"get",
 //        url: "/report-type/"+currentVal,
 //        success: function(data) {

	//       if(data.type == "qc_pass")
 //          {
 //          	$.each(data.items, function (index, datum) {
	//     		$('.document_no').append('<option type="qc_pass" data="'+datum.id+'" value="'+datum.document_no+'">'+datum.document_no+'</option>');
	//         });
 //          }
 //          else if(data.type == "verified_doc")
 //          {
	//         $.each(data.items, function (index, datum) {
	//     		$('.document_no').append('<option type="verified_doc" data="'+datum.id+'" value="'+datum.document_no+'">'+datum.document_no+'</option>');
	//         });
	//       }
 //        }
 //      });
	// });
	$(".document_no").on("change",function(){
		$('.reference_id').val('');
		$(".report-tr").remove();
		var referenceId = $(this).find('option:selected').attr('data');
		var type = $(this).find('option:selected').attr('type');
		$(".reference_id").val(referenceId);

		$.ajax({
	        type:"get",
	        url: "/report-data/"+referenceId,
	        success: function(data) {
	           //console.log(data);
	        $.each(data, function (index, datum) {
	        	console.log(datum);
	          $("#new_raw_report").append('<tr class="report-tr">'+
	          		'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
	          		'<td>'+datum.products.mfr+'</td>'+
	            	'<td>'+datum.products.part_num+'</td>'+
	            	'<td>'+datum.products.part_name+'</td>'+
	            	'<td>'+datum.products.part_desc+'</td>'+
	            	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_qc+'"  required="true"></td>'+
	            	'<td>'+datum.products.default_um+'</td>'+
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

	$('.source_type').on('change', function(){
		$('.source_name').empty().append('<option value="">Select</option>');
		var currVal = $(this).val();
		console.log(currVal);
		if(currVal == 'supplier'){
			$.ajax({
				type:"get",
				url: "/report-data-sup/"+source_id,
				success: function(data) {
			        $(".source_name").append("<option value='" + optiondata.id + "'>" + optiondata.name +"</option>");

				}
			});
		}
	})
    // $(".btn_addReport").on("click",function(){

    //     $(".new_rawReport").append('<tr>'+
    //     	'<td><input type="text" name="mfr[]" class="form-control m-input mfr" style="width: 100px;"></td>'+
    //     	'<td><input type="text" name="part_name[]" class="form-control m-input part_name"></td>'+
    //     	'<td><input type="text" name="description[]" class="form-control m-input description"></td>'+
    //     	'<td><input type="number" name="qty_receive[]" class="form-control m-input qty_receive" style="width: 100px;"></td>'+
    //     	'<td><input type="text" name="um[]" class="form-control m-input um" style="width: 100px;"></td>'+
    //     	'</tr>');
    // });
});
</script>
@endsection
