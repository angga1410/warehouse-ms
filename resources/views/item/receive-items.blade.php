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
							Receive Items
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-receiveitems-wh')}}">
					<div class="row">
					<div class="col-sm-12">
					<div class="row">
						
						<div class="col-sm-6">
							{!! csrf_field() !!}
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Reference Type</label>
								<select class="form-control m-input m-input--square reference_type" name="reference_type" required="true">
								<option value="">Select Reference Type</option>
								<option value="internal_department">Internal</option>
								<option value="dispatch_order">External</option>
								</select>
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Refference Item List</label>
								<select class="form-control m-input m-input--square reference_id"  name="document_no" required="true">
								<option value="">Select Item</option>
								
								</select>
							</div>
						</div>
						<div class="col-sm-6">	
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Sender</label>
								<!-- <input type="text" name="sender" class="form-control m-input" required="true"> -->
								<input type="text" class="form-control m-input name" name="name" style="border: none;" required="true" readonly>
								<input type="hidden" class="form-control m-input sender" name="sender" style="border: none;" required="true" readonly>
							</div>

							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Received By</label>
								<select class="form-control m-input m-input--square" name="received_by_id" required="true">
								<option value="">Select</option>
								@foreach($users as $user)
									<option value="{{$user->id}}">{{$user->name}}</option>
								@endforeach
								</select>
							</div>  

							<div class="form-group m-form__group">
										
										<input type="hidden" class="form-control m-input item_val" name="reference_id" style="border: none;" required="true">
									</div>
						</div>
							<!-- <div class="form-group m-form__group col-sm-6">
					    		<div class="m-typeahead">
									<input class="form-control m-input" id="searchPickItems" type="text" dir="ltr" placeholder="Search Item">
								</div>
							</div>  -->
					</div>
					
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw_receiveWh m--margin-top-20" id="new_raw_receiveWh"> 
						<thead>
					        <tr>
							<th></th>
					          <th>Id</th>
					          <th>Mfr.</th>
					          <th>Part Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Receive</th>
					          <th>U/M</th>
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit" id="btn_receive_items" style="display: none;" class="btn btn-primary">Submit</button>
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

	$('.reference_type').on('change',function(){
		$('.reference_id').empty().append('<option value="">Select Item</option>');
		$(".receivewh-tr").remove();
	var currentVal = $(this).val();
		$.ajax({
        type:"get",
        url: "/receiveItemswh-type/"+currentVal,
        success: function(data) { 
        
          if(data.type == "internal_department")
          {
          	$.each(data.items, function (index, datum) {
	    		$('.reference_id').append('<option type="internal_department" data="'+datum.store_item_request_id+'" value="'+datum.id+'">'+datum.id+'</option>');
	        });
          }
          else if(data.type == "dispatch_order")
          {
	        $.each(data.items, function (index, datum) {
				console.log(datum.document.document_no)
	    		$('.reference_id').append('<option type="dispatch_order" data="'+datum.receive_report_id+'" value="'+datum.document.document_no+'">'+datum.document.rr_num+'</option>');
	        });
	      }
        }
      });
	});

	var item_val = null;
	$('.reference_id').on('change',function(){
		$('.item_val').val('');
		$(".receivewh-tr").remove();
		$("#btn_receive_items").show();
    item_val = $(this).find('option:selected').attr('data');
    item_type = $(this).find('option:selected').attr('type');
	$(".item_val").val(item_val);
	console.log("test",item_val);
	
	$.ajax({
        type:"get",         
        url: "/receive-itemsWH-data/"+item_val+"/"+item_type,
        success: function(data) { 
			$(".name").val((data.name))
			$(".sender").val((data.id))
        $.each(data.itemPart, function (index, datum) {
        	console.log(data);
	
            $("#new_raw_receiveWh").append('<tr class="receivewh-tr">'+
			'<td><input type="checkbox" class="form-control m-input" ></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:55px;border:none;" ></td>'+
            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.products.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.products.part_num+'" readonly="true" style="width:100px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.products.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><textarea class="form-control" name="description[]"  readonly="true" >'+datum.products.part_desc+'</textarea></td>'+
            	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty'+index+'"  readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.products.default_um+'" style="width:75px;border:none;"></td>'+
            	'</tr>');
            if(item_type == 'internal_department'){
        		$(".qty"+index).val(datum.qty_request);
        	}else{
        		console.log(datum.qty_po);
        		$(".qty"+index).val(datum.qty_receive);
        	}

        });
        }
   	    });
	});
});
</script>
@endsection