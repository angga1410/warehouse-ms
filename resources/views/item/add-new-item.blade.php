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
							Add New Item
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-new-item')}}">
					<div class="row">
						
						<div class="col-sm-12">
							{!! csrf_field() !!}
							<!-- <div class="form-group m-form__group">
										<label for="exampleInputEmail1">Item Name</label>
										<input type="text" class="form-control m-input" name="item_name" required="true">
									</div> -->
							<div class="row">
								<div class="col-sm-6">
									
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">RR No.</label>
										<select class="form-control m-input m-input--square receive_report_id" name="receive_report_id" required="true">
										<option>Select RR No.</option>
										@foreach($reports as $report)
											<option value="{{$report->id}}">{{$report->id}}</option>
										@endforeach
										</select>
									</div>
									
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference</label>
										<select class="form-control m-input m-input--square" name="reference" required="true">
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
										<select class="form-control m-input m-input--square" name="source_type" required="true">
										<option value="supplier">Supplier</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Receiver</label>
										<select class="form-control m-input m-input--square" name="receiver_id" required="true">
										
										@foreach($users as $user)
											<option value="{{$user->id}}">{{$user->name}}</option>
										@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Document No.</label>
										<input type="text" class="form-control m-input document_no" name="document_no" style="border: none;" required="true">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference Type</label>
										<select class="form-control m-input m-input--square" name="reference_type" required="true">
										<option value="external">External</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">source Name</label>
										<input type="text" class="form-control m-input" name="source_name" required="true">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Reference</label>
										<select class="form-control m-input m-input--square" name="source_reference" required="true">
										<option value="external">External</option>
										</select>
									</div>
								</div>
							</div>
							
						
					<!-- <div class="form-group m-form__group text-center">
						<button type="button" name="btn_add" class="btn_add btn m-btn--pill  btn-warning pull-right" style="height:40px;width:150px; color:white;">Add New Part</button>
					</div> -->
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw m--margin-top-20" id="item_deatil"> 
						<thead>
					        <tr>
					          <th class="first">Mfr.</th>
					          <th class="second">Part Name</th>
					          <th class="third">Description</th>
					          <th class="seventh">Qty Receive</th>
					          <th class="eighth">U/M</th>
					          <th class="eighth">Warehouse</th>
					          <th class="eighth">Location\Rack</th>

					        </tr>
					    </thead>
					    <tbody>
					        <!-- <tr>
					          <td><input type="text" name="mfr[]" class="mfr form-control m-input" style="width: 100px;" required="true"></td>
					          <td><input type="text" name="part_name[]" class="part_name form-control m-input" style="width: 100px;"></td> 
					          <td><input type="text" name="description[]" class="description form-control m-input" required="true"></td>
					          <td><input type="text" name="qty_po[]" class="qty_po form-control m-input" style="width: 100px;" required="true"></td>
					          <td><input type="text" name="qty_sent[]" class="qty_sent form-control m-input" style="width: 100px;" required="true"></td>
					          <td><input type="text" name="balance[]" class="balance form-control m-input" style="width: 100px;" required="true"></td>
					          <td><input type="text" name="qty_receive[]" class="qty_receive form-control m-input" style="width: 100px;" required="true"></td>
					          <td><input type="text" name="um[]" class="um form-control m-input" style="width: 100px;" required="true"></td>
					          <td><select class="form-control m-input m-input--square warehouse_select" name="warehouse[]" required="true">
									@foreach($warehouses as $warehouse)
										<option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
									@endforeach
									</select>
							   </td>
							   <td><select class="form-control m-input m-input--square location_select" name="location_rack[]">
									
									</select>
							   </td>
					        </tr> -->
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit" style="display: none;" class="btn btn-primary" id="btn_item">Submit</button>
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
	$('.receive_report_id').on('change',function(){
		$('.document_no').val("");
		$(".item-tr").remove();
		$("#btn_item").show();
		var currenr_val = $(this).val();
		var reports_item = <?php echo json_encode($reports); ?>;
		jQuery.each(reports_item,function( i, report){
			if(currenr_val == report.id){
				$(".document_no").val(report.document_no);
			}
		});	
				// request_val = $(this).val();
		$.ajax({
	        type:"get",
	        url: "/report-itemlist/"+currenr_val,
	        success: function(data) { 
	           console.log(data);
	        $.each(data, function (index, datum) {
	        	console.log(datum);
	          
	            var warehouses_array = <?php echo json_encode($warehouses); ?>;
		    	var warhouse_list = "";
		        $.each(warehouses_array,function( i, warehouse){
		            warhouse_list += '<option value="'+warehouse.id+'">'+warehouse.name+'</option>';
		        });

		        $(".new_raw").append('<tr class="item-tr">'+
		        	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
	            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
	            	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.description+'" readonly="true" style="width:75px;border:none;"></td>'+
	            	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_receive" style="width: 100px;" value="'+datum.qty_receive+'" required="true"></td>'+
	            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.um+'" style="width:75px;border:none;"></td>'+
		        	'<td><select class="form-control m-input m-input--square warehouse_select"  name="warehouse[]">'+warhouse_list+'</select></td>'+
		        	'<td><select class="form-control m-input m-input--square location_select"  name="location_rack[]"></select></td>'+
		        	'</tr>');

	    		});
				}
			});
	});
    $('#item_deatil').on("change",".warehouse_select",function(){
    	var currentVal = $(this).val();
		var that = this;
		// var curr_location = $(that).closest("tr").find('.location_data').val();

		$(that).closest("tr").find(".location_select").empty();
		var warehouse_item = <?php echo json_encode($warehouses); ?>;
		jQuery.each(warehouse_item,function( i, warehouse){
			if(currentVal == warehouse.id){
				jQuery.each(warehouse.warehouse_location,function( i, location){	
				$(that).closest("tr").find(".location_select").append('<option value="'+location.id+'">'+location.location+'</option>');
				});
			}
        });
	})
});
</script>
@endsection