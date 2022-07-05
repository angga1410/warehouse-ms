@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content" id="updateQueue">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Update Entry Queue
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/update-queue')}}">
					<div class="row">
						<input type="hidden" name="e_queue_id" value="{{$queueList->id}}">
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-4">
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Document No.</label>
									<input type="text" class="form-control m-input" name="document_no" value="{{$queueList->document_no}}" required="true">
								</div>
								</div>
								<div class="col-sm-4">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Send via Mover</label>
									<select class="form-control m-input m-input--square" name="mover" required="true">
									<option value="">Select Mover</option>
									@foreach($movers as $mover)
										<option @if($queueList->mover_id == $mover->id) selected="selected" @endif value="{{$mover->id}}">{{$mover->name}}</option>
									@endforeach
									</select>
								</div>
								</div>
								<div class="col-sm-4">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Send via Employee</label>
									<select class="form-control m-input m-input--square" name="employee" required="true">
									<option value="">Select Employee</option>
									@foreach($users as $user)
										<option @if($queueList->user_id == $user->id) selected="selected" @endif value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
									</select>
								</div>
								</div>
							</div>
								<!-- <div class="form-group m-form__group text-center">
									<button type="button" name="btn_add" class="btn_add btn m-btn--pill  btn-warning pull-right" style="height:40px;width:150px; color:white;">Add New Part</button>
								</div> -->
								
								<div class="form-group m-form__group text-center">
									<button type="submit" class="btn btn-primary">Submit</button>
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
$(function(){

    
});
</script>
@endsection