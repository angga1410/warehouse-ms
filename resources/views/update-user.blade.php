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
							Update User
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form method="post" action="{{url('/update-user')}}">
								<input type="hidden" name="user_id" value="{{$user->id}}">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Name</label>
									<input type="text" class="form-control m-input" value="{{$user->name}}" name="name" required="true">
								</div>
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Email</label>
									<input type="text" class="form-control m-input" value="{{$user->email}}" name="email" required="true">
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Department</label>
									<select class="form-control m-input m-input--square" name="department" required="true">
										<option @if($user->department == 'admin') selected="selected" @endif value="admin">Admin</option>
										<option @if($user->department == 'loading_department') selected="selected" @endif value="loading_department">Loading Department</option>
										<option @if($user->department == 'warehouse') selected="selected" @endif value="warehouse">Warehouse</option>
										<option @if($user->department == 'internal_department') selected="selected" @endif value="internal_department">Internal Department</option>
									</select>
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Department</label>
									<select class="form-control m-input m-input--square" name="status" required="true">
										<option @if($user->status == 0) selected="selected" @endif value="0">Pending</option>
										<option @if($user->status == 1) selected="selected" @endif value="1">Approve</option>
										<option @if($user->status == 2) selected="selected" @endif value="2">Reject</option>
									</select>
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