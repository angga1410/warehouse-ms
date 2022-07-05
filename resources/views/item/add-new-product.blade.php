@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Add New Product
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form method="post" action="{{url('/new-product')}}">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">MFR </label>
									<input type="text" class="form-control m-input" name="mfr" required="true">
								</div>
								{!! csrf_field() !!}
							
						
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Product Number</label>
									<input type="text" class="form-control m-input" name="product_number" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Part Name</label>
									<input type="text" class="form-control m-input" name="part_name" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Description</label>
									<textarea rows="5" class="form-control m-input" name="description" required="true"></textarea>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Minimum Order Quantity</label>
									<input type="text" class="form-control m-input" name="moq" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">UM</label>
									<input type="text" class="form-control m-input" name="um" required="true" value="each" readonly>
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