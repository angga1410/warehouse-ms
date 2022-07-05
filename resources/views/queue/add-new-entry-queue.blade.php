@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content" id="addQueue">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Add New Entry Queue
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-new-entry-queue')}}" id="entry_queue">
					<div class="row">
						
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Document No.</label>
									<input type="text" class="form-control m-input" name="document_no" required>
								</div>
								</div>
								<div class="col-sm-4">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Send via Mover</label>
									<select class="form-control m-input m-input--square" name="mover" required>
									<option value="">Select Mover</option>
									@foreach($movers as $mover)
										<option value="{{$mover->id}}">{{$mover->name}}</option>
									@endforeach
									</select>
								</div>
								</div>
								<div class="col-sm-4">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Send via Employee</label>
									<select class="form-control m-input m-input--square" name="employee" required>
									<option value="">Select Employee</option>
									@foreach($users as $user)
										<option value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
									</select>
								</div>
								</div>
							</div>
								
								<div class="form-group m-form__group text-center">
									<button type="submit" class="btn btn-primary btn_entry_queue">Submit</button>
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
@section('script')
<script type="text/javascript">

</script>
@endsection