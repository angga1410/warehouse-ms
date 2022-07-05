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
							Edit QC Request
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/update-qcRequest')}}">
					<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
							<input type="hidden" name="qcrequest_id" value="{{$qcRequestData->id}}">

								{!! csrf_field() !!}
								<!-- <div class="form-group m-form__group">
									<label for="exampleInputEmail1">Queue Number</label>
									<input type="text" class="form-control m-input" name="entry_queue_id" readonly="true" value="{{$qcRequestData->entry_queue_id}}" required="true">
								</div> -->
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Document No.</label>
									<input type="text" readonly class="form-control m-input" name="document_no" value="{{$qcRequestData->document->reference_rr}}" required="true" required="true">
								</div>

								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">QC By</label>
									<select class="form-control m-input m-input--square" name="qc_by" required="true">
									<option value="">Select</option>
									@foreach($users as $user)
										<option @if($qcRequestData->qc_by == $user->id) selected="selected" @endif value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Remark</label>
									<textarea rows="5" class="form-control m-input" name="remark" required="true">{{$qcRequestData->remark}}</textarea>
								</div>

								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Request Status</label>
									<select class="form-control m-input m-input--square" name="request_status" required="true">
									<option @if($qcRequestData->status == 1) selected="selected" @endif value="0">On Progress</option>
									
									<option @if($qcRequestData->status == 2) selected="selected" @endif value="2">Pass QC </option>
									<option @if($qcRequestData->status == 3) selected="selected" @endif value="3">QC Rejected </option>
									<!-- <option @if($qcRequestData->status == 4) selected="selected" @endif value="4">QC Partial Rejected </option> -->
									</select>
								</div>
							</div>
						</div>
					<!-- <div class="form-group m-form__group text-center">
						<button type="button" name="btn_add_qc" class="btn_add_qc btn m-btn--pill    btn-warning pull-right" style="width:150px; color:white;">Add New Part</button>
					</div> -->
						<div class="form-group m-form__group table-responsive">
							<table class="table m-table m-table--head-bg-metal new_qc_raw m--margin-top-20">
							<thead>
						        <tr>
						          <th>Id</th>
						          <th class="first">Mfr.</th>
						          <th class="second">Product Number</th>
						          <th class="second">Part Name</th>
						          <th class="third">Description</th>
						          <th class="fourth">Qty Qc</th>
						          <th class="fifth">U/M</th>

						        </tr>
						    </thead>
						    <tbody>
						    @foreach($qcRequestData->qcrequestitems as $qc_item)
						        <tr>
						          <td><input type="text" name="id[]" class="form-control m-input id" value="{{$qc_item->id}}" style="width: 100px;border:none;" readonly></td>

						          <td><input type="text" name="mfr[]" class="form-control m-input--squaremfr" value="{{$qc_item->products->mfr}}" style="width: 100px;border:none;" readonly></td>

						          <td><input type="text" name="product_number[]" class="form-control m-input product_number" value="{{$qc_item->products->part_num}}" style="border:none;" readonly></td>

						          <td><input type="text" name="part_name[]" class="form-control m-input part_name" value="{{$qc_item->products->part_name}}" style="border:none;" readonly></td>
						          <td><input type="text" name="description[]" class="form-control m-input description" value="{{$qc_item->products->part_desc}}" style="border:none;" readonly></td>

						          <td><input type="text" name="qty_qc[]" class="form-control m-input qty_po" style="width: 100px;" value="{{$qc_item->qty_qc}}" required></td>

						          <td><input type="text" name="um[]" class="form-control m-input um" style="width: 100px;border:none;" value="{{$qc_item->products->default_um}}" readonly></td>

						        </tr>
						     @endforeach
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
    $(".btn_add_qc").on("click",function(){
        $(".new_qc_raw").append('<tr>'+
        	'<td><input type="text" name="mfr[]" class="form-control m-input mfr" style="width: 100px ;border:none;" readonly></td>'+
        	'<td><input type="text" name="product_number[]" class="form-control m-input product_number" style="width: 100px;border:none;" readonly></td>'+
        	'<td><input type="text" name="part_name[]" class="form-control m-input part_name" style="border:none;" readonly></td>'+
        	'<td><input type="text" name="description[]" class="form-control m-input description" style="border:none;" readonly></td>'+
        	'<td><input type="text" name="qty_qc[]" class="form-control m-input qty_qc" style="width: 100px;" required></td>'+
        	'<td><input type="text" name="um[]" class="form-control m-input um" style="width: 100px;border:none;" readonly></td>'+
        	'</tr>');
    });
});
</script>
@endsection
