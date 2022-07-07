@extends('layout.admin.base')
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content" id="storeItems">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Altenate UM
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/save-alt-um')}}">
				<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-4">
							{!! csrf_field() !!}
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Reference Type</label>
								<select class="form-control m-input m-input--square reference_type" name="reference_type" required="true">
								<option value="">Select Reference Type</option>
								<option value="internal_department">Internal</option>
								<option value="dispatch_order">External</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4">	
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Refference Item List</label>
								<select class="form-control m-input m-input--square reference_id" name="reference_id" required="true">
								<option value="">Select Item</option>
								
								</select>
							</div>
						</div>
					
					</div>
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw_receive m--margin-top-20" id="new_raw_receive"> 
						<caption>Already Saved</caption>
						<thead>
					        <tr>
                            <th>ID</th>
					          <th>ID</th>
					          <th>Mfr.</th>
					          <th>Part Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Sent</th>
					          <th>U/M</th>
                              <th>Alternate Qty </th>
					          <th>Alternate U/M </th>
					      
							 
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
		
					<div class="form-group m-form__group text-center">
						<button type="submit" id="btn_sentitem" style="display: none;" class="btn btn-primary">Submit</button>
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
$(function () {
  $("select").select2();
});
$(function(){
	
	$('.reference_type').on('change',function(){
		$('.reference_id').empty().append('<option value="">Select Item</option>');
		$(".storeitem").remove();
	var currentVal = $(this).val();
		$.ajax({
        type:"get",
        url: "/storeItems-type/"+currentVal,
        success: function(data) { 
           console.log(data);
	        $.each(data, function (index, datum) {
	    		$('.reference_id').append('<option  value="'+datum.id+'">'+datum.rr.rr_num+'</option>');
	        });
        }
      });
	});


	var receive_val = null;
	$('.reference_id').on('change',function(){
		$(".storeitem-tr").remove();
		$("#btn_sentitem").show();
    receive_val = $(this).val(); 
	console.log(receive_val);
	
	$.ajax({
        type:"get",         
        url: "/store-itemdata/"+receive_val,
        success: function(data) { 
           
        $.each(data, function (index, datum) {
    		
    		var warehouse_item = <?php echo json_encode($warehouses); ?>;
		
			
				var warhouse_list = "";
	  

			$("#new_raw_receive").append('<tr class="storeitem-tr">'+
            '<td><input type="text" class="form-control m-input" name="id[]" value="'+datum.id+'" readonly="true" style="width:5px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:5px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.products.mfr+'" readonly="true" style="width:175px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.products.part_num+'" readonly="true" style="width:150px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.products.part_name+'" readonly="true" style="width:150px;border:none;"></td>'+
            	'<td><textarea type="text" class="form-control m-input" name="description[]" value="" readonly="true" style="border:none;width:280px;">'+datum.products.part_desc+'</textarea></td>'+
            	'<td><input type="text" class="form-control m-input" value="'+datum.qty_receive+'" readonly="true" style="width:75px;border:none;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.products.default_um+'"  readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="qty_alt[]"  style="width:75px;"></td>'+
            	'<td><input type="text" class="form-control m-input" name="um_alt[]" value="'+datum.products.alt_um+'"   style="width:75px;"></td>'+
				
				
            	'</tr>');


        	
	    
			



          
            // var curr_location = datum.location_rack;
		   
		    // var currentVal = datum.warehouse;
			// 	jQuery.each(warehouse_item,function( i, warehouse){
			// 		if(currentVal == warehouse.id){
			// 			jQuery.each(warehouse.warehouse_location,function( i, location){	
			// 			$('#storeItems .warehouse_select').closest("tr").find(".location_select").append('<option @if('+curr_location == location.id+')selected="selected" @endif value="'+location.id+'">'+location.location+'</option>');
			// 			});
			// 		}
		    //     });

        });

        // $('#storeItems .warehouse_select').on("change",function(){
		// 	var currentVal = $(this).val();
		// 	var that = this;
		// 	var curr_location = $(that).closest("tr").find('.location_data').val();

		// 	$(that).closest("tr").find(".location_select").empty();
		// 	var warehouse_item = <?php echo json_encode($warehouses); ?>;
		// 	jQuery.each(warehouse_item,function( i, warehouse){
		// 		if(currentVal == warehouse.id){
		// 			jQuery.each(warehouse.warehouse_location,function( i, location){	
		// 			$(that).closest("tr").find(".location_select").append('<option @if('+curr_location == location.id+')selected="selected" @endif value="'+location.id+'">'+location.location+'</option>');
		// 			});
		// 		}
	    //     });
		// })

        }
   	    });
	});
});
</script>
@endsection