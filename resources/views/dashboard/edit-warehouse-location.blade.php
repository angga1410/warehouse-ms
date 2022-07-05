@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Edit Warehouse Location
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form method="post" action="{{url('/update-warehouse-location/'.$warehouseLocation->id)}}">
								<div class="form-group m-form__group">
									<label>Warehouse</label>
									<select name="warehouse_id" class="form-control m-input m-input--solid" required="true">
										@foreach($warehouseList as $warehouse)
											<option @if($warehouse->id == $warehouseLocation->warehouse_id) selected="selected" @endif value="{{$warehouse->id}}">{{$warehouse->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group m-form__group">
									<label>Warehouse Location</label>
									<input type="text" class="form-control m-input" name="zone" value="{{$warehouseLocation->zone}}" required="true">
								</div>
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label>Warehouse Description</label>
									<textarea rows="5" class="form-control m-input" name="zone_description" required="true">{{$warehouseLocation->zone_description}}</textarea>
								</div>
								<div class="form-group m-form__group text-center">
									<button type="submit" class="btn btn-primary">Update</button>
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