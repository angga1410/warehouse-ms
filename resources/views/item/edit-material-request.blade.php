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
							Update Material Request
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/update-material-request')}}" id="update_material_request_form">
					<div class="row">
						
						<div class="col-sm-12">
							{!! csrf_field() !!}
							<input type="hidden" name="request_id" value="{{$materialData->id}}">
							
							<div class="row">
								<div class="col-sm-6">
								<div class="form-group m-form__group" hidden>
										
										<select class="form-control m-input m-input--square" name="reference_type" required="true">
									
										<option value="internal_department">Internal</option>
									
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">MR Name</label>
										<input readonly value="{{$materialData->mr_name}}" class="form-control m-input m-input--square" name="mr_name" required="true">
										
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source</label>
										<select class="form-control m-input m-input--square" name="source" required="true">
										<option @if($materialData->source == 'internal') selected="selected" @endif value="internal">Internal</option>
										<option @if($materialData->source == 'external') selected="selected" @endif value="external">External</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Type</label>
										<select class="form-control m-input m-input--square source_type" name="source_type" required="true">
										<option @if($materialData->source_type == 'supplier') selected="selected" @endif value="supplier">Supplier</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Requester</label>
										<input  value="{{$materialData->requester_id}}" class="form-control m-input m-input--square" name="requester_id" required="true">
										
									</div>
								
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference</label>
										<select class="form-control m-input m-input--square" name="reference" required="true">
										<option @if($materialData->reference == 'internal') selected="selected" @endif value="internal">Internal</option>
										<option @if($materialData->reference == 'external') selected="selected" @endif value="external">External</option>
										</select>
									</div>
									<div class="form-group m-form__group">
									<label for="exampleInputEmail1">Request Status</label>
										<select class="form-control m-input m-input--square" name="request_status" required="true">
										<option @if($materialData->is_approve == 0) selected="selected" @endif value="0">Pending</option>
										<option @if($materialData->is_approve == 1) selected="selected" @endif value="1">Approve</option>
										<option @if($materialData->is_approve == 3) selected="selected" @endif value="3">Reject</option>
										</select>
									</div>
									<!-- <div class="form-group m-form__group">
										<label for="exampleInputEmail1">source Name</label> -->
										<!-- <input type="text" class="form-control m-input" name="source_name" value="{{$materialData->source_name}}" required="true"> -->
										<!-- <select class="form-control m-input m-input--square source_id" name="source_id" required="true">
											<option value="">Select source</option>
											@foreach($suppliers as $supplier)
												<option @if($materialData->source_id == $supplier->id) selected="selected" @endif value="{{$supplier->id}}">{{$supplier->name}}</option>
											@endforeach
										</select>
									</div> -->
								
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
						
					    @foreach($materialData->materialrequest as $m_request_item)
					    <tr class="dataRowEdit">
					    <input type="hidden" name="material_request_item_id[]" value="{{$m_request_item->id}}">
					        
					          <!-- <td><input type="text" name="id[]" class="form-control m-input material_request_itemid" value="{{$m_request_item->id}}" readonly="true" style="width:100px;border:none;"></td>
					          <td><input type="text" name="mfr[]" class="form-control m-input mfr_material" value="{{$m_request_item->mfr}}" readonly="true" style="width:100px;border:none;"></td>
					          <td><input type="text" name="part_name[]" class="form-control m-input part_name_material" value="{{$m_request_item->part_name}}" readonly="true" style="width:100px;border:none;"></td>
					          <td><input type="text" name="description[]" class="form-control m-input description_material" value="{{$m_request_item->description}}" readonly="true" style="width:100px;border:none;"></td>
					          <td><input type="text" name="qty_request[]" class="form-control m-input qty_request_material" value="{{$m_request_item->qty_request}}" style="width:100px;"></td>
					          <td><input type="text" name="um[]" class="form-control m-input um_material" value="{{$m_request_item->um}}" readonly="true" style="width:100px;border:none;"></td>
					          <td><a class="deleteItemEdit btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm" value="{{$m_request_item->id}}"><i class="la la-close"></i></a></td> -->
						 
							  <td>{{$m_request_item->products->id}}</td>
					            <td>{{$m_request_item->products->mfr}}</td>
							    <td>{{$m_request_item->products->part_num}}</td>
							    <td>{{$m_request_item->products->part_name}}</td>
							    <td>{{$m_request_item->products->part_desc}}</td>
							    <td><input type="number" name="qty_request[]" value="{{$m_request_item->qty_request}}" class="form-control m-input qty_receive" style="width: 100px;" required="true"></td>
							    <td>{{$m_request_item->products->default_um}}</td>
							    <td><a class="deleteItemEdit btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm" value="{{$m_request_item->id}}"><i class="la la-close"></i></a></td>
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
	$(".deleteItemEdit").on("click",function(){
		var id =  $(this).attr("value");
			$.ajax({
                    url:"/delete-material-parts",
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