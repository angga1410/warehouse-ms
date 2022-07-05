@extends('layout.admin.base')
@section('style')
<style type="text/css">
	.dataRowEdit input{
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
							Update Store Item Request
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/update-storeitem-request')}}" id="update_storeitem_request_form">
					<div class="row">
						
						<div class="col-sm-12">
							{!! csrf_field() !!}
							<input type="hidden" name="request_id" value="{{$storeitemData->id}}">
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference</label>
										<select class="form-control m-input m-input--square" name="reference" required="true">
										<option @if($storeitemData->reference == 'external') selected="selected" @endif value="internal">{{$storeitemData->reference}}</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source</label>
										<select class="form-control m-input m-input--square" name="source" required="true">
										<option @if($storeitemData->source == 'external') selected="selected" @endif value="external">{{$storeitemData->source}}</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Type</label>
										<select class="form-control m-input m-input--square source_type" name="source_type" required="true">
										<option @if($storeitemData->source_type == 'supplier') selected="selected" @endif value="supplier">{{$storeitemData->source_type}}</option>
										</select>
									</div>
									<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Request Status</label>
										<select class="form-control m-input m-input--square" name="request_status" required="true">
										<option @if($storeitemData->status == 0) selected="selected" @endif value="0">Pending</option>
										<option @if($storeitemData->status == 1) selected="selected" @endif value="1">Approve</option>
										<option @if($storeitemData->status == 2) selected="selected" @endif value="2">Decline</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference Type</label>
										<select class="form-control m-input m-input--square" name="reference_type" required="true">
										<option @if($storeitemData->reference_type == 'external') selected="selected" @endif value="external">{{$storeitemData->reference_type}}</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">source Name</label>
										<!-- <input type="text" class="form-control m-input" name="source_name" value="{{$storeitemData->source_name}}" required="true"> -->
										<select class="form-control m-input m-input--square source_id" name="source_id" required="true">
											<option value="">Select source</option>
											@foreach($suppliers as $supplier)
												<option @if($storeitemData->source_id == $supplier->id) selected="selected" @endif value="{{$supplier->id}}">{{$supplier->name}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Requester</label>
										<select class="form-control m-input m-input--square" name="requester_id" required="true">
										<option>Select Requester</option>
										@foreach($users as $user)
											<option @if($user->id == $storeitemData->user->id) selected="selected" @endif value="{{$user->id}}">{{$user->name}}</option>
										@endforeach
										</select>
									</div>
								</div>
							</div>	
						
					<!-- <div class="form-group m-form__group text-center">
						<button type="button" name="btn_add" class="btn_add btn m-btn--pill  btn-warning pull-right" style="height:40px;width:150px; color:white;">Add New Item</button>
					</div> -->
					<div class="form-group m-form__group table-responsive">
						<table id="new_raw_edit" class="table m-table m-table--head-bg-metal new_raw_edit m--margin-top-20"> 
						<thead>
					        <tr>
					          <th>Id</th>
					          <th>Mfr.</th>
					          <th>Part Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Request</th>
					          <th>U/M</th>
					          <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					    @foreach($storeitemData->storeitemrequestitem as $s_request_item)
					        <tr class="dataRowEdit">
					          <input type="hidden" name="storeitem_request_item_id[]" class="form-control m-input" value="{{$s_request_item->id}}" readonly="true" style="width:50px;border:none;">
					          <td>{{$s_request_item->products->id}}</td>
					          <td>{{$s_request_item->products->mfr}}</td>
					          <td>{{$s_request_item->products->product_number}}</td>
					          <td>{{$s_request_item->products->part_name}}</td>
					          <td>{{$s_request_item->products->description}}</td>
					          <td><input type="text" name="qty_request[]" class="form-control m-input qty_request_storeitem" value="{{$s_request_item->qty_request}}" style="width:100px;"></td>
					          <td>{{$s_request_item->products->um}}</td>
					          <td><a class="deleteStoreItemEdit btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm" value="{{$s_request_item->id}}"><i class="la la-close"></i></a></td>
					        </tr>
					    @endforeach
					    </tbody>
				        </table>
					</div>
					
					<div class="form-group m-form__group text-center">
						<button type="submit" class="btn btn-warning m--font-light">Update</button>
					</div>
				</div>
				</div>			
				</form>
				<input type="hidden" id="token" value="{{csrf_token()}}">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
$(function(){
	$('.source_type').on('change', function(){
		$('.source_name').empty().append('<option value="">Select</option>');
		var currVal = $(this).val();
		console.log(currVal);
		if(currVal == 'supplier'){
			$.ajax({
				type:"get",
				url: "/supplier-list",
				success: function(data) { 
			        $.each(data, function (index, optiondata) {
			            $(".source_name").append("<option value='" + optiondata.id + "'>" + optiondata.name +"</option>");
			        });
			        
				}
			});
		}
	});
	$(".deleteStoreItemEdit").on("click",function(){
		var id =  $(this).attr("value");
			$.ajax({
                    url:"/delete-storeitem-parts",
                    method:"post",
                    data:{'id':id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Item Deleted.");
                        // location.reload();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
			$(this).closest ('tr').remove ();
	});

});
</script>
@endsection