@extends('layout.admin.base')
@section('style')
<style type="text/css">
	.dataRow input{
		border: none!important;
	}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Add New Store Item Request
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-new-storeitem-request')}}">
					<div class="row">
						
						<div class="col-sm-12">
							{!! csrf_field() !!}
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference</label>
										<select class="form-control m-input m-input--square" name="reference" required="true">
										<option value="internal">Internal</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source</label>
										<select class="form-control m-input m-input--square" name="source" required="true">
										<option value="external">External</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Type</label>
										<select class="form-control m-input m-input--square source_type" name="source_type" required="true">
										<option value="">Select</option>
										<option value="supplier">Supplier</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference Type</label>
										<select class="form-control m-input m-input--square" name="reference_type" required="true">
										<option value="external">External</option>
										</select>
									</div>
									<!-- <div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Name</label>
										<select class="form-control m-input m-input--square source_id" name="source_id" required="true">
											<option value="">Select source</option>
											
										</select>
									</div> -->
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Requester</label>
										<select class="form-control m-input m-input--square" name="requester_id" required="true">
										<option value="">Select Requester</option>
										@foreach($users as $user)
											<option value="{{$user->id}}">{{$user->name}}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>
							
							<div class="form-group m-form__group col-sm-6">
					    		<div class="m-typeahead">
									<input class="form-control m-input" id="storeItemRequest" type="text" dir="ltr" placeholder="Search Item" >
								</div>
							</div>	
						
							<div class="form-group m-form__group table-responsive">
								<table class="table m-table m-table--head-bg-metal new_raw_storeItemRequest m--margin-top-20" id="new_raw_storeItemRequest"> 
								<thead>
							        <tr>
							        <tr>
							          <th>Id</th>
							          <th class="first">Mfr.</th>
							          <th class="second">Part Number</th>
							          <th class="second">Part Name</th>
							          <th class="third">Description</th>
									  <th class="eighth">U/M</th>
							         
									  <th class="seventh">Qty</th>
                                 
									  <th class="eighth">Action</th>
							        </tr>
							    </thead>
							    <tbody>
							        
							    </tbody>
						        </table>
							</div>
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
    // $('.source_type').on('change', function(){
	// 	$('.source_name').empty().append('<option value="">Select</option>');
	// 	var currVal = $(this).val();
	// 	console.log(currVal);
	// 	if(currVal == 'supplier'){
	// 		$.ajax({
	// 			type:"get",
	// 			url: "/supplier-list",
	// 			success: function(data) { 
	// 		        $.each(data, function (index, optiondata) {
	// 		            $(".source_id").append("<option value='" + optiondata.id + "'>" + optiondata.name +"</option>");
	// 		        });
			        
	// 			}
	// 		});
	// 	}
	// });
 $('#new_raw_storeItemRequest').on('click', '.deleteStoreItem', function(){
    $(this).closest ('tr').remove ();
});

});
</script>
@endsection