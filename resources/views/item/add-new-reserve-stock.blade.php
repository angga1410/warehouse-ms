@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
@include('flash::message')
	<div class="m-content">

<!-- 
	<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg mod" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Replace Items</h5>
                <button type="button" class="close deleteItem" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
			<form id="ajaxform">
                <meta name="csrf-token" content="{{ csrf_token() }}" />
			<div class="form-group m-form__group">
						<label for="exampleInputEmail1">Search Items</label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" id="searchProduct" type="text" dir="ltr" placeholder="Search Product">
						</div>
					</div>
                <table class="table" id="tableLoc">
				<input type="hidden" class="form-control m-input product_id_old" name="product_id_old" style="border: none;" required="true">
				<input type="hidden" class="form-control m-input qc_id" name="qc_id" style="border: none;" required="true">
                    <thead class=" text-dark">
					<th>Id</th>
							          <th class="first">Mfr.</th>
							          <th class="second">Part Number</th>
							          <th class="second">Part Name</th>
							          <th class="third">Description</th>
							         
							          <th class="eighth">U/M</th>
									  <th class="eighth">Action</th>
                    </thead>

                </table>
				<button class="btn btn-secondary save-update" data-dismiss="modal" id="btnupdate">Replace</button>
			</form>
            </div>
        </div>
    </div>
</div> -->

		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							Add New Report
						</h3>
					</div>
				</div>
			</div>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
			<div class="m-portlet__body">
				<div class="col-sm-12">
				<form method="post" action="{{url('/add-new-report')}}">
					<div class="row">

						<div class="col-sm-12">
							{!! csrf_field() !!}

                            <div class="form-group m-form__group">
						<label for="exampleInputEmail1">Search Items</label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" id="searchProduct" type="text" dir="ltr" placeholder="Search Product">
						</div>
					</div>
							<div class="form-group m-form__group table-responsive">
                            <table class="table" id="tableLoc">
				<input type="hidden" class="form-control m-input product_id_old" name="product_id_old" style="border: none;" required="true">
				<input type="hidden" class="form-control m-input qc_id" name="qc_id" style="border: none;" required="true">
                    <thead class=" text-dark">
					<th>Id</th>
							          <th class="first">Mfr.</th>
							          <th class="second">Part Number</th>
							          <th class="second">Part Name</th>
							          <th class="third">Description</th>
							         
							          <th class="eighth">U/M</th>
									  <th class="eighth">Action</th>
                    </thead>

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


$('#tableLoc').on('click', '.deleteItem', function(){
    $(this).closest ('tr').remove ();
	$("#searchProduct").prop('disabled', false);
});

function replace(id,qc_id){
	console.log(id,qc_id)
    $('#tableLoc').DataTable().clear().destroy();
    $('#form').modal('show');
    $(".product_id_old").val(id);
	$(".qc_id").val(qc_id);
	$("#searchProduct").prop('disabled', false);
	var engine = new Bloodhound({
            remote:{

               
				url: "{{ URL::to('/products-data?term=%QUERY%') }}",
               
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchProduct").typeahead({
            hint: true,
            highlight: true,
            minLength:1
            }, 
            {
                source: engine.ttAdapter(),
                 displayKey: 'part_num',
                 limit:50,
                templates: {
                    empty: [
                        '<div class="empty-message">unable to find any</div>'
                    ],
                                suggestion: function (data) 
                                {
                                     return '<li id="suggestion">' + data.part_num +' - '+data.part_name +'</li>'
                                }

                }

         });
        $('#searchProduct').on('typeahead:selected', function (e, datum) {
            // $("#btn_qc").show();
            $("#tableLoc").append('<tr class"table-replace">'+
                // '<td><input type="text" class="form-control m-input" name="product_id[]" value="1" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="product_id" value="'+datum.id+'" readonly="true" style="width:50px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" value="'+datum.mfr+'" readonly="true" style="width:90px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input"  value="'+datum.part_num+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input"  value="'+datum.part_name+'" readonly="true" style="width:90px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input"  value="'+datum.part_desc+'" readonly="true" style="width:175px;border:none;"></td>'+
               
                '<td><input type="text" class="form-control m-input" value="'+datum.default_um+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+
                '</tr>');

				$("#searchProduct").prop('disabled', true);
            
        });

}

$(function(){

	$(".document_no").on("change",function(){
		$('.reference_id').val('');
		$(".report-tr").remove();
		var referenceId = $(this).find('option:selected').attr('data');
		var type = $(this).find('option:selected').attr('type');
		$(".reference_id").val(referenceId);

		$.ajax({
        type:"get",
        url: "qc/"+referenceId,
        success: function(data2) { 
			
			// console.log(data2);
			$.each(data2, function () {
				$(".site").val(data2.document.source_name);
				$(".source").val(data2.document.source_id);
				$(".reference_type").val(data2.document.reference);
				$(".sender").val(data2.document.sender_name);
				$(".sender_phone").val(data2.document.sender_phone);
				$(".remark").val(data2.document.remark);
				$(".sources").val(data2.document.source);
			
				$.ajax({
					
        type:"get",
        url: "mover/"+data2.document.mover_id,
        success: function(data3) {  

			$(".mover").val(data3.name);
			$(".mover_id").val(data3.id);
			// console.log(data3.name);
		} });


	        });
        
        }
      });

		$.ajax({
	        type:"get",
	        url: "/report-data/"+referenceId,
	        success: function(data) {
	           //console.log(data);
	        $.each(data, function (index, datum) {
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
					referenceId+')">Replace</a></td>'+
	          		'</tr>');
	          
	    		});
			}
     	});
	});


});
$(function () {
  $("select").select2();
});

</script>
@endsection
