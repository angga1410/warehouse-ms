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
							Edit Mover
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
						<form method="post" action="{{url('/update-customer/'.$customer->id)}}">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Customer Name</label>
									<input type="text" class="form-control m-input" name="name" value="{{$customer->name}}" required="true">
								</div>
								{!! csrf_field() !!}
								
                                <div class="form-group m-form__group">
									<label for="exampleInputEmail1">Address</label>
									<textarea rows="5" class="form-control m-input" name="address" required="true">{{$customer->address}}</textarea>
								</div>
								{!! csrf_field() !!}
                                <div class="form-group m-form__group">
									<label for="exampleInputEmail1">City</label>
									<input type="text" class="form-control m-input" name="city" value="{{$customer->city}}" required="true">
                                </div>
                                {!! csrf_field() !!}
                                <div class="form-group m-form__group">
									<label for="exampleInputEmail1">Lantitude</label>
									<input type="text" class="form-control m-input" name="lantitude" value="{{$customer->lantitude}}" required="true">
                                </div>
                                {!! csrf_field() !!}
                                <div class="form-group m-form__group">
									<label for="exampleInputEmail1">Longitude</label>
									<input type="text" class="form-control m-input" name="longitude" value="{{$customer->longitude}}" required="true">
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