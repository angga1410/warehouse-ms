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
							Packing Items 
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-packing-items')}}">
					<div class="row">
						
						<div class="col-sm-12">
						<div class="row">
						    <div class="col-sm-4">
							{!! csrf_field() !!}
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Refference Item List</label>
								<select class="form-control m-input m-input--square receiveitem_id" name="send_items_from_wh_id" required="true">
								<option value="">Select Item</option>
								@foreach($sendItems as $sendItem)
									<option value="{{$sendItem->id}}" data="{{$sendItem->pick_item_id}}">{{$sendItem->id}}</option>
								@endforeach
								</select>
							</div>
							</div>

							<div class="col-sm-4">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Do</label>
								<select class="form-control m-input m-input--square" name="do_id" required="true">
								<option value="">Select</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
								</select>
							</div>  
							</div>

							<div class="col-sm-4">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Pack By</label>
								<select class="form-control m-input m-input--square" name="pack_by_id" required="true">
								<option value="">Select</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
								</select>
							</div>  
							</div>
							<div class="form-group m-form__group col-sm-6">
					    		<div class="m-typeahead">
									<input class="form-control m-input" id="searchPickItems" type="text" dir="ltr" placeholder="Search Item">
								</div>
							</div> 
						</div>
					
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw_packing m--margin-top-20" id="new_raw_packing"> 
						<thead>
					        <tr>
					          <th>ID</th>
					          <th>Mfr.</th>
					          <th>Part Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Sent</th>
					          <th>U/M</th>
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit" class="btn btn-primary" style="display: none;" id="btn_packing">Submit</button>
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
	
	var pack_val = null;
	$('.receiveitem_id').on('change',function(){
		$(".packing-tr").remove();
	$("#btn_packing").show();
    pack_val = $(this).find('option:selected').attr('data');
    console.log(pack_val);
	$.ajax({
        type:"get",         
        url: "/packing-itemsdata/"+pack_val,
        success: function(data) { 
           
        $.each(data, function (index, datum) {
    
            $("#new_raw_packing").append('<tr class="packing-tr">'+
            	'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" class="form-control m-input" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.products.mfr+'" readonly="true" class="form-control m-input" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.products.part_num+'" readonly="true" class="form-control m-input" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.products.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.products.part_desc+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="qty_pack[]" value="'+datum.qty_picked+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.products.default_um+'" style="width:75px;border:none;"></td>'+
            	'<input type="hidden" value="'+datum.warehouse+'" name="warehouse[]">'+
                '<input type="hidden" value="'+datum.location_rack+'" name="location_rack[]">'+
            	'</tr>');

        });
        }
   	    });
	});
});
</script>
@endsection