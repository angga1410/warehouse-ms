@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content">


	<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg mod" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Add Items</h5>
                <button type="button" class="close deleteItem" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
		
            </div>
        </div>
    </div>
</div>

		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Create Document for Request Items
						</h3>
					</div>
				</div>
			</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/save-inventory-request')}}">
					<div class="row">

						<div class="col-sm-12">
							{!! csrf_field() !!}

							<div class="row">
							
							
								<div class="col-sm-6">
								<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Document Number</label>
										<input class="form-control m-input m-input--square document_no" name="document_no" required="true">
										
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Source</label>
										<select class="form-control m-input m-input--square" name="source" required="true">
										<option value="GA">GA</option>
										<option value="Workshop">Logistic</option>
										<option value="Project">Project</option>
										<option value="PPIC">PPIC</option>
										<option value="Workshop">Workshop</option>
										</select>
									</div>

									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Purpose</label>
										<textarea class="form-control m-input m-input--square source_type" name="purpose" required="true"></textarea>
										
									</div>
								</div>
									<div class="col-sm-6">
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Request By</label>
										<select class="form-control m-input m-input--square" name="request_by" required="true">
											@foreach($emp as $get)
										<option value="{{$get->id}}">{{$get->first_name}} {{$get->middle_name}} {{$get->last_name}}</option>
								@endforeach
										</select>
									</div>
									<div class="form-group m-form__group">
										<label for="exampleInputEmail1">Remark</label>
										<textarea rows="5" class="form-control m-input remark" name="remark" required="true" ></textarea>
									</div>
									</div>
								
							</div>


					<!-- <div class="form-group m-form__group text-center">
						<button type="button" name="btn_addReport" class="btn_addReport btn m-btn--pill  btn-warning pull-right" style="height:40px;width:150px; color:white;">Add Report Detail</button>
					</div> -->
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>Search Items</b></label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" id="searchProduct1" type="text" dir="ltr" placeholder="Search Product">
						</div>
					</div>
							<div class="form-group m-form__group table-responsive">
								<table class="table m-table m-table--head-bg-metal new_raw_report m--margin-top-20" id="new_raw_report">
								<thead>
							        <tr>
							          <th>Id</th>
							          <th class="first">Mfr.</th>
							          <th class="second">Part Number</th>
							          <th class="second">Part Name</th>
							          <th class="third">Description</th>
									  <th class="eighth">U/M</th>
							          <th class="seventh">Qty in Stock</th>
									  <th class="seventh">Qty Request</th>
									  <th class="eighth">Action</th>
							        </tr>
							    </thead>
							    <tbody>
							        <!-- <tr>
							          <td><input type="text" name="mfr[]" class="form-control m-input mfr" style="width: 100px;" required="true"></td>
							          <td><input type="text" name="part_name[]" class="form-control m-input part_name" required="true"></td>
							          <td><input type="text" name="description[]" class="form-control m-input description" required="true"></td>
							          <td><input type="number" name="qty_receive[]" class="form-control m-input qty_receive" style="width: 100px;" required="true"></td>
							          <td><input type="text" name="um[]" class="form-control m-input um" style="width: 100px;" required="true"></td>
							        </tr> -->
							    </tbody>
						        </table>
							</div>
							<div class="form-group m-form__group text-center">
								<button type="submit" class="btn btn-primary">Save</button>
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
 $(".save-update").click(function(event) {
        event.preventDefault();
		$(".report-tr").remove();
		$(".table-replace").remove();
        let product_id_old = $("input[name=product_id_old]").val();
		let qc_id = $("input[name=qc_id]").val();
        let product_id = $("input[name=product_id]").val();

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "/replace",
            type: "POST",
            data: {
                product_id_old: product_id_old,
				qc_id: qc_id,
                product_id: product_id,
                _token: _token
            },
            success: function(response) {
			
                if (response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                }
            },
        });
		$(".report-tr").remove();
		refreshqc1(qc_id);
		refreshqc(qc_id);
		function refreshqc(qc_id){
		$.ajax({
	        type:"get",
	        url: "/report-data/"+qc_id,
	        success: function(data4) {
	           //console.log(data);
	        $.each(data4, function (index, datum) {
	        	// console.log(datum);
	          $("#new_raw_report").append('<tr class="report-tr">'+
	          		'<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
	          		'<td>'+datum.products.mfr+'</td>'+
	            	'<td>'+datum.products.part_num+'</td>'+
	            	'<td>'+datum.products.part_name+'</td>'+
	            	'<td>'+datum.products.part_desc+'</td>'+
	            	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_qc+'"  required="true"></td>'+
	            	'<td>'+datum.products.default_um+'</td>'+
					'<td><a class="btn btn-primary text-light"  onclick="replace('+
					datum.id+','+
					qc_id+')">Replace</a></td>'+
	          		'</tr>');
	           
	    		});
			}
     	});
	}
	function refreshqc1(qc_id){
		$.ajax({
	        type:"get",
	        url: "/report-data/"+qc_id,
	        success: function(data5) {
			}
     	});
	}

    });


$('#new_raw_report').on('click', '.deleteItem', function(){
    $(this).closest ('tr').remove ();
	$("#searchProduct").prop('disabled', false);
});


$(function () {
  $("select").select2();
});

$(function () {
	var engine = new Bloodhound({
            remote:{

               
				url: "{{ URL::to('/inventory-request?term=%QUERY%') }}",
               
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchProduct1").typeahead({
            hint: true,
            highlight: true,
            minLength:
            }, 
            {
                source: engine.ttAdapter(),
                 displayKey: 'part_num',
                 limit:20,
                templates: {
                    empty: [
                        '<div class="empty-message">unable to find any</div>'
                    ],
                                suggestion: function (data) 
                                {
                                     return '<li id="suggestion">' + data.part_num +' - '+data.mfr +'- '+data.part_name +'- '+data.part_desc +'('+data.wh_name +'-'+data.wh_loc +')</li>'
                                }

                }

         });
        $('#searchProduct1').on('typeahead:selected', function (e, datum) {
            // $("#btn_qc").show();
			console.log("ok")
            $("#new_raw_report").append('<tr class"table-replace">'+
                // '<td><input type="text" class="form-control m-input" name="product_id[]" value="1" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.id+'" readonly="true" style="width:90px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" value="'+datum.mfr+'" readonly="true" style="width:120px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input"  value="'+datum.part_num+'" readonly="true" style="width:120px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input"  value="'+datum.part_name+'" readonly="true" style="width:120px;border:none;"></td>'+
                '<td><textarea type="text" class="form-control m-input"  readonly="true" style="width:200px;border:none;">'+datum.part_desc+'</textarea></td>'+
				'<td><input type="text" class="form-control m-input" value="'+datum.default_um+'" readonly="true" style="width:75px;border:none;"></td>'+
				'<td><input type="number" class="form-control m-input"   value="'+datum.qty+'" readonly="true" style="width:120px;border:none;"></td>'+
              
				'<td><input type="number" class="form-control m-input" max="'+datum.qty+'" name="qty[]" style="width:120px;"></td>'+
                '<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+
                '</tr>');

				$('#form').modal('hide');
				$('#searchProduct').val('');
            
        });
});

$('#new_raw_report').on('click', '.deleteItem', function(){
    $(this).closest ('tr').remove ();
});

</script>
@endsection
