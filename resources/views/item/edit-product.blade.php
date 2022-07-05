@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Edit Product
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form method="post" action="{{url('/update-product/'.$product->id)}}">
							
								<div class="form-group m-form__group">
									<label>Manufacture</label>
									<input type="text" class="form-control m-input" name="mfr" value="{{$product->mfr}}" required="true">
								</div>
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label>Product Number</label>
									<input type="text" class="form-control m-input" name="product_number" required="true" value="{{$product->product_number}}">
								</div>
                                {!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label>Part Name</label>
									<input type="text" class="form-control m-input" name="part_name" required="true" value="{{$product->part_name}}">
								</div>
                                {!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label>Descrption</label>
									<textarea rows="5" class="form-control m-input" name="description" required="true">{{$product->description}}</textarea>
								</div>
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label>Minimum Order Quantity</label>
									<input type="text" class="form-control m-input" name="moq" required="true" value="{{$product->moq}}">
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