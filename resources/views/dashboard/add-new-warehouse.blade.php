@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Add New Warehouse
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form method="post" action="{{url('/add-new-warehouse')}}">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Warehouse Name</label>
									<input type="text" class="form-control m-input" name="name" required="true">
								</div>
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Description</label>
									<textarea rows="5" class="form-control m-input" name="description" required="true"></textarea>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Address 1</label>
									<textarea rows="5" class="form-control m-input" name="address1" required="true"></textarea>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Address 2</label>
									<textarea rows="5" class="form-control m-input" name="address2" required="true"></textarea>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">City</label>
									<input type="text" class="form-control m-input" name="city" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Zipcode</label>
									<input type="text" class="form-control m-input" name="zipcode" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Country</label>
									<input type="text" class="form-control m-input" name="country" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Lattitude</label>
									<input type="text" class="form-control m-input" name="lattitude" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Longitude</label>
									<input type="text" class="form-control m-input" name="longitude" required="true">
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