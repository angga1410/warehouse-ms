@extends('layout.admin.base')
@section('style')
<style type="text/css">
	select.m-select2
	{
		opacity: 1!important;
	}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
	<div class="m-content" id="pickItem">

		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					
					<div class="m-portlet__head-title">
						
						<h3 class="m-portlet__head-text">
							Pick Item from Request Document
						</h3>
					</div>
				</div>
			</div>
			<div class="m-portlet__body">
				
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-pick-item-req-doc')}}">
				<div class="row">
				<div class="col-sm-12">
					<div class="row">
						{!! csrf_field() !!}
						<div class="col-sm-4">
						<div class="form-group m-form__group">
							<label for="exampleInputEmail1">Reference Document</label>
							<select class="form-control m-input m-input--square reference" name="material_request_id" required="true">
                            <option >Select Document</option>
                                @foreach($document as $get)
							<option value="{{$get->id}}">{{$get->document_no}}</option>
							<!-- <option value="internal_department">Internal (MR)</option>
							<option value="dispatch_order">External</option> -->
                            @endforeach
							</select>
						</div>
						</div>
						<div class="col-sm-4">
			
						</div>
						<div class="col-sm-4">
						<div class="form-group m-form__group">
							<label for="exampleInputEmail1">Pick By</label>
							<select class="form-control m-input m-input--square" name="pick_by_id" required="true">
							<option value="">Select</option>
							@foreach($users as $user)
								<option value="{{$user->id}}">{{$user->name}}</option>
							@endforeach
							</select>
						</div>
						</div>	
						<!-- <div class="form-group m-form__group col-sm-6">
				    		<div class="m-typeahead">
								<input class="form-control m-input" id="searchPickItems" type="text" dir="ltr" placeholder="Search Item">
							</div>
						</div>	 -->
					</div>
					
					<small>*Jika terdapat PN yang sama, mohon pilih salah satu gudang yang dituju dan hapus yang tidak dipilih</small>	
					
					
					<div class="form-group m-form__group table-responsive">
						<table class="table m-table m-table--head-bg-metal new_raw_pick m--margin-top-20" id="new_raw_pick"> 
						<thead>
					        <tr>
					          <th>Mfr.</th>
					          <!-- <th>MR Item Id</th> -->
					          <th>Part Number</th>
					          <th>Part Name</th>
					          <th>Description</th>
					          <th>Qty Request</th>
					          <th>Qty Picked</th>
					          <th>U/M</th>
					          <th>Warehouse</th>
							  <th>Location</th>
							  <th>Comment</th>
							  <th>Action</th>
					     
					        </tr>
					    </thead>
					    <tbody>
					        
					    </tbody>
				        </table>
					</div>
					<div class="form-group m-form__group text-center">
						<button type="submit" style="display: none;" class="btn btn-primary" id="btn_pick_item">Submit</button>
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

	// $('.reference_type').on('change',function(){
	// 	$('.pick-tr').remove();
	// 	$('.reference').empty().append('<option>Select Item</option>');
	// var currentVal = $(this).val();
	// 	$.ajax({
    //     type:"get",
    //     url: "/pickitem-type/"+currentVal,
    //     success: function(data) { 
    //        console.log(data);
	//         $.each(data, function (index, datum) {
	//     		$('.reference').append('<option value="'+datum.id+'">'+datum.mr_name+'</option>');
	//         });
    //     }
    //   });
	// });

	var request_val = null;
	$('.reference').on('change',function(){
		$('.pick-tr').remove();
		$("#btn_pick_item").show();
	request_val = $(this).val();
    console.log(request_val)
	$.ajax({
        type:"get",
        url: "/pick-item-data-req-doc/"+request_val,
        success: function(data) { 
           
        $.each(data, function (index, datum) {
        	console.log(datum);


            $("#new_raw_pick").append('<tr class="pick-tr">'+
            	'<input type="hidden" class="product_id" name="product_id[]" value="'+datum.id+'">'+
				'<input type="hidden" class="product_id" name="wh_id[]" value="'+datum.wh_id+'">'+
				'<input type="hidden" class="product_id" name="mr_detail_id[]" value="'+datum.mr_detail_id+'">'+
            	// '<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:90px;border:none;"></td>'+
            	// // '<td><input type="text" class="form-control m-input" name="item_id[]" value="'+datum.id+'" readonly="true" style="width:50px;border:none;"></td>'+
            	// '<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.part_num+'" readonly="true" style="width:75px;border:none;"></td>'+
            	// '<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:90px;border:none;"></td>'+
            	// '<td><textarea type="text" class="form-control m-input" name="description[]" readonly="true" >'+datum.part_desc+'</textarea></td>'+
				// '<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.qty+'" readonly="true" style="width:75px;"></td>'+
            	// '<td><input type="text" class="form-control m-input" name="qty_picked[]" value=""  style="width:90px;"></td>'+
				// '<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.default_um+'" style="width:60px;border:none" readonly></td>'+
				// '<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.warehouse+'" style="width:100px;border:none" readonly></td>'+
            	// '<td><input type="text" class="form-control m-input" name="" style="width:70px;" required></td>'+
            
            	'<td><textarea type="text" class="form-control m-input" readonly="true" >'+datum.mfr+'</textarea></td>'+
				'<td><textarea type="text" class="form-control m-input"  readonly="true" >'+datum.part_num+'</textarea></td>'+
				'<td><textarea type="text" class="form-control m-input"  readonly="true" >'+datum.part_name+'</textarea></td>'+
				'<td><textarea type="text" class="form-control m-input"  readonly="true" >'+datum.part_desc+'</textarea></td>'+
				'<td><input type="text" class="form-control m-input"  value="'+datum.qty+'" readonly="true" style="width:75px;"></td>'+
				'<td><input type="number" class="form-control m-input" name="qty_picked[]" max="'+datum.qty+'" value=""  style="width:90px;"></td>'+
				'<td><input type="text" class="form-control m-input" value="'+datum.default_um+'" style="width:60px;border:none" readonly></td>'+
				'<td><textarea type="text" class="form-control m-input" readonly="true" >'+datum.warehouse+'</textarea></td>'+
				'<td><textarea type="text" class="form-control m-input"  readonly="true" >'+datum.location+'</textarea></td>'+
				'<td><textarea type="text" class="form-control m-input" name="comment[]"  ></textarea></td>'+
				'<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+
            	'</tr>');
           
    //         var curr_location = datum.location_rack;
		   
		  //   var currentVal = datum.warehouse;
				// jQuery.each(warehouse_item,function( i, warehouse){
				// 	if(currentVal == warehouse.id){
				// 		jQuery.each(warehouse.warehouse_location,function( i, location){	
				// 		$('#pickItem .warehouse_select').closest("tr").find(".location_select").append('<option value="'+location.id+'">'+location.location+'</option>');
				// 		});
				// 	}
		  //       });
            
        });

        // $('#pickItem .warehouse_select').on("change",function(){
		// 	var currentVal = $(this).val();
		// 	var that = this;
		// 	var curr_location = $(that).closest("tr").find('.location_data').val();

		// 	$(that).closest("tr").find(".location_select").empty();
		// 	var warehouse_item = <?php echo json_encode($warehouses); ?>;
		// 	$.each(warehouse_item,function( i, warehouse){
		// 		if(currentVal == warehouse.id){
		// 			$.each(warehouse.warehouse_location,function( i, location){	
		// 			$(that).closest("tr").find(".location_select").append('<option value="'+location.id+'">'+location.location+'</option>');
		// 			});
		// 		}
	    //     });
		// })
        }
   	    });
	});
});
$(function () {
  $("select").select2({
	
});
});
$('#new_raw_pick').on('click', '.deleteItem', function(){
    $(this).closest ('tr').remove ();
});
//'<input type="hidden" class="location_data" name="" value="'+datum.location_rack+'">'+
</script>
@endsection