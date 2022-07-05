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
							Add New Mover
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form method="post" action="{{url('/add-new-mover')}}">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Mover Name</label>
									<input type="text" class="form-control m-input" name="name" required="true">
								</div>
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Mover Description</label>
									<textarea rows="5" class="form-control m-input" name="description" required="true"></textarea>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Mover Contact Person</label>
									<input type="text" class="form-control m-input" name="contact" required="true">
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