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
							Change Password
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form method="post" action="{{url('/change-password')}}">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Old Password</label>
									<input type="password" class="form-control m-input" name="old_password" required="true">
								</div>
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">New Password</label>
									<input type="password" class="form-control m-input" name="new_password" required="true"> 
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Re-Enter New Password</label>
									<input type="password" class="form-control m-input" name="reentered_password" required="true">
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