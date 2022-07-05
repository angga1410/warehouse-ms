@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Add Warehouse Racking
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form method="post" action="{{url('/add-new-warehouse-racking')}}">
								<div class="form-group m-form__group">
									<label>Warehouse Zone</label>
									<select name="location_id" class="form-control m-input m-input--solid" required="true">
										@foreach($warehouseList as $warehouse)
											<option value="{{$warehouse->id}}">{{$warehouse->zone}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group m-form__group">
									<label>Rack</label>
									<input type="text" class="form-control m-input" name="rack" required="true">
								</div>
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label>Rack Description</label>
									<textarea rows="5" class="form-control m-input" name="rack_desc" required="true"></textarea>
								</div>
								<div class="form-group m-form__group">
									<label>Level</label>
									<input type="text" class="form-control m-input" name="level" required="true">
								</div>
								
								<div class="form-group m-form__group">
									<label>Bin</label>
									<input type="text" class="form-control m-input" name="bin" required="true">
								</div>
							
								<div class="form-group m-form__group text-center">
									<button type="submit" class="btn btn-primary">Submit</button>
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