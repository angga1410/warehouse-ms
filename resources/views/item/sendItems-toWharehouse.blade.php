@extends('layout.admin.base')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Send Items To Warehouse
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-sendItem-toWarehouse')}}">
					<div class="row">
						<div class="col-sm-12">
						<div class="row">
						    <div class="col-sm-4">
							{!! csrf_field() !!}
							
							<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Refference Report Products</label>
										<select class="form-control m-input m-input--square document_no" name="document_no" required="true">
										<option value="">Select Document</option>
										 @foreach($itemLists as $qcpass)
										 	<option value="{{$qcpass->document_no}}" data="{{$qcpass->id}}">{{$qcpass->rr_num}}</option>
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
								<label for="exampleInputEmail1">Hand-Over By</label>
								<select class="form-control m-input m-input--square" name="handover_by_id" required="true">
								<option value="">Select</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
								</select>
							</div>
							<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference No.</label>
										<input type="text" class="form-control m-input reference_id" name="item_id" style="border: none;" required="true">
									</div>
							</div>
						</div>
							<!-- <div class="form-group m-form__group col-sm-6">
					    		<div class="m-typeahead">
									<input class="form-control m-input" id="searchPickItems" type="text" dir="ltr" placeholder="Search Item">
								</div>
							</div>  -->

						<div class="form-group m-form__group table-responsive">
							<table class="table m-table m-table--head-bg-metal new_raw_sendtowh m--margin-top-20" id="new_raw_sendtowh">
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
							<button type="submit" class="btn btn-primary" id="btn_senditem_towh" style="display: none;">Submit</button>
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

	var whItem_id = null;
	$('.wh_item_id').on('change',function(){
		$(".sendtowh-tr").remove();
		$("#btn_senditem_towh").show();
    whItem_id = $(this).val();
	$.ajax({
        type:"get",
        url: "/sendItem-toWarehouse-data/"+whItem_id,
        success: function(data) {

        $.each(data, function (index, datum) {
    		 $("#new_raw_sendtowh").append('<tr class="report-tr">'+
		  		'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
		  		'<td>'+datum.products.mfr+'</td>'+
		    	'<td>'+datum.products.part_num+'</td>'+
		    	'<td>'+datum.products.part_name+'</td>'+
		    	'<td>'+datum.products.part_desc+'</td>'+
		    	'<td>'+datum.qty_receive+'</td>'+
		    	'<td>'+datum.products.default_um+'</td>'+
		    	'<input type="hidden" value="'+datum.warehouse+'" name="warehouse[]">'+
                '<input type="hidden" value="'+datum.location_rack+'" name="location_rack[]">'+
		  		'</tr>');
            // $("#new_raw_sendtowh").append('<tr class="sendtowh-tr">'+
            // 	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
            // 	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
            // 	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.description+'" readonly="true" style="width:75px;border:none;"></td>'+
            // 	'<td><input type="text" class="form-control m-input" name="qty_send[]" value="'+datum.qty_po+'" readonly="true" style="width:75px;border:none;"></td>'+
            // 	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.um+'" style="width:75px;border:none;"></td>'+
            // 	'<input type="hidden" value="'+datum.warehouse+'" name="warehouse[]">'+
            //     '<input type="hidden" value="'+datum.location_rack+'" name="location_rack[]">'+
            // 	'</tr>');

        });
        }
   	    });
	});
});

$(".document_no").on("change",function(){
		$('.reference_id').val('');
		$(".report-tr").remove();
		$("#btn_senditem_towh").show();
		var referenceId = $(this).find('option:selected').attr('data');
		var type = $(this).find('option:selected').attr('type');
		$(".reference_id").val(referenceId);

		$.ajax({
	        type:"get",
	        url: "/sendItem-toWarehouse-data/"+referenceId,
	        success: function(data) {
	           //console.log(data);
	        $.each(data, function (index, datum) {
	        	console.log(datum);
	          $("#new_raw_sendtowh").append('<tr class="report-tr">'+
	          		'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
	          		'<td>'+datum.products.mfr+'</td>'+
	            	'<td>'+datum.products.part_num+'</td>'+
	            	'<td>'+datum.products.part_name+'</td>'+
	            	'<td>'+datum.products.part_desc+'</td>'+
	            	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_receive+'"  required="true"></td>'+
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
	$(function () {
  $("select").select2();
});

</script>
@endsection
