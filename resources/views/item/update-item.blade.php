@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content" id="updateItem">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Add New Item
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/update-item')}}">
					<div class="row">
						<input type="hidden" name="item_id" value="{{$itemData->id}}">
						<div class="col-sm-12">
							{!! csrf_field() !!}
							<!-- <div class="form-group m-form__group">
										<label for="exampleInputEmail1">Item Name</label>
										<input type="text" class="form-control m-input" name="item_name" required="true">
									</div> -->
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference</label>
										<select class="form-control m-input m-input--square" name="reference" required="true">
										<option @if($itemData->source_type == 'internal') selected="selected" @endif value="internal">Internal</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source</label>
										<select class="form-control m-input m-input--square" name="source" required="true">
										<option @if($itemData->source == 'external') selected="selected" @endif value="external">External</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Type</label>
										<select class="form-control m-input m-input--square" name="source_type" required="true">
										<option @if($itemData->source_type == 'supplier') selected="selected" @endif value="supplier">Supplier</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Receiver</label>
										<select class="form-control m-input m-input--square" name="receiver_id" required="true">
										
										@foreach($users as $user)
										<option @if($itemData->receiver_id == $user->id) selected="selected" @endif value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Document No.</label>
										<input type="text" class="form-control m-input document_no" name="document_no" style="border: none;" required="true" value="{{$itemData->document_no}}" readonly="true">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Reference Type</label>
										<select class="form-control m-input m-input--square" name="reference_type" required="true">
										<option @if($itemData->source_type == 'external') selected="selected" @endif value="external">External</option>
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">source Name</label>
										<input type="text" class="form-control m-input" name="source_name" value="{{$itemData->source_name}}" required="true">
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source Reference</label>
										<select class="form-control m-input m-input--square" name="source_reference" required="true">
										<option @if($itemData->source_type == 'external') selected="selected" @endif value="external">External</option>
										</select>
									</div>
								</div>
							</div>
							
						
					<!-- <div class="form-group m-form__group text-center">
						<button type="button" name="btn_add" class="btn_add btn m-btn--pill  btn-warning pull-right" style="height:40px;width:150px; color:white;">Add New Part</button>
					</div> -->
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw m--margin-top-20" id="item_deatil"> 
						<thead>
					        <tr>
					          <th class="first">Mfr.</th>
					          <th class="second">Part Name</th>
					          <th class="third">Description</th>
					          <th class="seventh">Qty Receive</th>
					          <th class="eighth">U/M</th>
					          <th class="eighth">Warehouse</th>
					          <th class="eighth">Location\Rack</th>

					        </tr>
					    </thead>
					    <tbody>
					     @foreach($itemData->itemdetail as $itemList)
							<input type="hidden" name="item_detail_id[]" value="{{$itemList->id}}">
					        <tr>
					          <td><input type="text" name="mfr[]" value="{{$itemList->mfr}}" class="mfr form-control m-input" style="width: 100px;" required="true"></td>
					          <td><input type="text" name="part_name[]" value="{{$itemList->part_name}}" class="part_name form-control m-input" style="width: 100px;"></td> 
					          <td><textarea rows="1" class="form-control m-input" name="description[]" style="width: 150px;" required="true">{{$itemList->description}}</textarea></td>
					          <td><input type="text" name="qty_receive[]" class="qty_receive form-control m-input" value="{{$itemList->qty_po}}" style="width: 100px;" required="true"></td>
					          <td><input type="text" name="um[]" value="{{$itemList->um}}" class="um form-control m-input" style="width: 100px;" required="true"></td>
					          <td><select class="form-control m-input m-input--square warehouse_select" name="warehouse[]" required="true">
								@foreach($warehouses as $warehouse)
									<option @if($itemList->warehouse == $warehouse->id) selected="selected" @endif value="{{$warehouse->id}}">{{$warehouse->name}}</option>
								@endforeach
									</select>
							   </td>
							   <td><select class="form-control m-input m-input--square location_select" name="location_rack[]">
									
								</select>
							   </td>
							   <input type="hidden" class="location_data" name="" value="{{$itemData->location_rack}}">
					        </tr>
					    @endforeach
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit"  class="btn btn-primary" id="btn_item">Submit</button>
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
	var curr_location = $('#updateItem .warehouse_select').closest("tr").find('.location_data').val();
    var warehouse_item = <?php echo json_encode($warehouses); ?>;
    var currentVal = $('#updateItem .warehouse_select').val();
		jQuery.each(warehouse_item,function( i, warehouse){
			if(currentVal == warehouse.id){
				jQuery.each(warehouse.warehouse_location,function( i, location){	
				$('#updateItem .warehouse_select').closest("tr").find(".location_select").append('<option @if('+curr_location == location.id+')selected="selected" @endif value="'+location.id+'">'+location.location+'</option>');
				});
			}
        });
    $('#item_deatil').on("change",".warehouse_select",function(){
    	var currentVal = $(this).val();
		var that = this;
		var curr_location = $(that).closest("tr").find('.location_data').val();

		$(that).closest("tr").find(".location_select").empty();
		var warehouse_item = <?php echo json_encode($warehouses); ?>;
		jQuery.each(warehouse_item,function( i, warehouse){
			if(currentVal == warehouse.id){
				jQuery.each(warehouse.warehouse_location,function( i, location){	
				$(that).closest("tr").find(".location_select").append('<option @if('+curr_location == location.id+')selected="selected" @endif value="'+location.id+'">'+location.location+'</option>');
				});
			}
        });
	})
});
</script>
@endsection