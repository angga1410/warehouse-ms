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
							Add New Return Report
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-new-report-return')}}">
					<div class="row">
						
						<div class="col-sm-12">
							{!! csrf_field() !!}
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Document No.</label>
										<select class="form-control m-input m-input--square document_no" name="document_no" required="true">
										<option>Select Document</option>
										@foreach($returnData as $data)
											<option data="{{$data->id}}" value="{{$data->document_no}}">{{$data->document_no}}</option>
										@endforeach
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
										<label for="exampleInputEmail1">Sender</label>
										<input type="text" class="form-control m-input" name="sender" required="true">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Remark</label>
										<textarea rows="5" class="form-control m-input" name="remark" required="true"></textarea>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference No.</label>
										<input type="text" class="form-control m-input reference_id" name="reference_id" style="border: none;" required="true" readonly="true">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">source Name</label>
										<input type="text" class="form-control m-input" name="source_name" required="true">
									</div>
									
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Mover</label>
										<select class="form-control m-input m-input--square" name="mover_id" required="true">
										<option>Select mover</option>
										@foreach($movers as $mover)
											<option value="{{$mover->id}}">{{$mover->name}}</option>
										@endforeach
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Sender Phone</label>
										<input type="text" class="form-control m-input" name="sender_phone" required="true">
									</div>
								</div>
							</div>
							
						
					<!-- <div class="form-group m-form__group text-center">
						<button type="button" name="btn_addReport" class="btn_addReport btn m-btn--pill  btn-warning pull-right" style="height:40px;width:150px; color:white;">Add Report Detail</button>
					</div> -->
							<div class="form-group m-form__group table-responsive">
								<table class="table m-table m-table--head-bg-metal new_raw_report_return m--margin-top-20" id="new_raw_report_return"> 
								<thead>
							        <tr>
							          <th class="first">Mfr.</th>
							          <th class="second">Part Name</th>
							          <th class="third">Description</th>
							          <th class="seventh">Qty Return</th>
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
	
	$(".document_no").on("change",function(){
		$('.reference_id').val('');
		$(".report-tr").remove();
		var referenceId = $(this).find('option:selected').attr('data');
		
		$(".reference_id").val(referenceId);

		$.ajax({
	        type:"get",
	        url: "/report-return-data/"+referenceId,
	        success: function(data) { 
	           console.log(data);
	        $.each(data, function (index, datum) {
	        	console.log(datum);
	          
	            $("#new_raw_report_return").append('<tr class="report-tr">'+
	            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
	            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
	            	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.description+'" readonly="true" style="width:75px;border:none;"></td>'+
	            	'<td><input type="text" name="qty_return[]" value="'+datum.qty_return+'"class="form-control m-input" style="width: 100px;"  required="true"></td>'+
	            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.um+'" style="width:75px;border:none;"></td>'+
	            	'</tr>');
	            	
	    		});
			}
     	});
	})
});
</script>
@endsection