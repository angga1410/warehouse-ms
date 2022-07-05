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
							Update Return Serial No
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form method="post" action="{{url('/update-returnsrno')}}">
								<input type="hidden" name="returnsrno_id" value="{{$returnSrNo->id}}">
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">QC Return No :</label>&nbsp
									<label>{{$returnSrNo->qc_return_id}}</label> 
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Document Number :</label>&nbsp
									<label>{{$returnSrNo->document_no}}</label> 
								</div>
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Product Number :</label>&nbsp
									<label>{{$returnSrNo->product_number}}</label>
								</div>
								{!! csrf_field() !!}
								<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Serial Number</label>
									<input type="text" class="form-control m-input" value="{{$returnSrNo->serial_no}}" name="serial_no" required="true">
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