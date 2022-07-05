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
							Update Return Report
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/update-report-return')}}">
					<div class="row">

					<div class="col-sm-12">
						{!! csrf_field() !!}
						<div class="row">
							<div class="col-sm-6">
								<input type="hidden" name="report_id" value="{{$reportLists->id}}">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Document No.</label>
									<input type="text" class="form-control m-input" name="document_no" value="{{$reportLists->document_no}}" readonly="true" style="border: none;" required="true">
								</div>

								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Source</label>
									<select class="form-control m-input m-input--square" name="source" required="true">
									<option @if($reportLists->source == 'external') selected="selected" @endif value="external">External</option>
									</select>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Source Type</label>
									<select class="form-control m-input m-input--square" name="source_type" required="true">
									<option @if($reportLists->source_type == 'supplier') selected="selected" @endif value="supplier">Supplier</option>
									</select>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Sender</label>
									<input type="text" class="form-control m-input" name="sender" value="{{$reportLists->sender}}" required="true">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">source Name</label>
									<input type="text" class="form-control m-input" name="source_name" value="{{$reportLists->source_name}}"required="true">
								</div>

								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Mover</label>
									<select class="form-control m-input m-input--square" name="mover_id" required="true">
									<option>Select mover</option>
									@foreach($movers as $mover)
										<option @if($reportLists->mover_id == $mover->id) selected="selected" @endif value="{{$mover->id}}">{{$mover->name}}</option>
									@endforeach
									</select>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Sender Phone</label>
									<input type="text" class="form-control m-input" name="sender_phone" value="{{$reportLists->sender_phone}}" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Remark</label>
									<textarea rows="5" class="form-control m-input" name="remark" required="true">{{$reportLists->remark}}</textarea>
								</div>
							</div>
						</div>
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
						     @foreach($reportLists->returndetail as $reportList)
						        <tr>
						        <input type="hidden" name="detail_id[]" value="{{$reportList->id}}">
						          <td><input type="text" name="mfr[]" value="{{$reportList->mfr}}" class="form-control m-input mfr" style="width: 100px;" required="true"></td>
						          <td><input type="text" name="part_name[]" value="{{$reportList->part_name}}" class="form-control m-input part_name" required="true"></td>
						          <td><input type="text" name="description[]" value="{{$reportList->description}}" class="form-control m-input description" required="true"></td>
						          <td><input type="number" name="qty_return[]" value="{{$reportList->qty_return}}" class="form-control m-input qty_return" style="width: 100px;" required="true"></td>
						          <td><input type="text" name="um[]" value="{{$reportList->um}}" class="form-control m-input um" style="width: 100px;" required="true"></td>
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
