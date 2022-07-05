@extends('layout.admin.base')
@section('stylesheet')


@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="transactionInventory">
@include('flash::message')
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">Tracking PO DO</h3>
			</div>
		</div>
	</div>
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
	
			</div>
			<input type="hidden" id="token" value="{{csrf_token()}}">
			<div class="m-portlet__body">
                <div class="row">
            
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
                    <div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>Search PO (PO - DO)</b></label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" style="width: 700px;" id="searchProduct1" type="text" dir="ltr" placeholder="Search Product">
						</div>
					</div>
					</div>
				</div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          
              
             
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <br>
                <div class="row">           
                         <div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>PO#</b></label>
			    		<div class="m-typeahead">
							<input class="form-control m-input"  style="width: 300px;" type="text" id="rr_id" name="rr_id" readonly>
						</div>
					</div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>PO Vendor</b></label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" style="width: 300px;" id="po_id" type="text" name="po_id" readonly>
						</div>
					</div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>PO Date</b></label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" style="width: 300px;" id="po_date" type="text" name="po_date" readonly>
						</div>
					</div>
                </div>
				</div>
           
                </div>
				<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
					<table class="table table-striped- table-bordered table-hover table-checkable" id="transaction_inventory_list">
						<thead>
							<tr>
								<th>DO#</th>
                                <th>DO DATE</th>
                                <th>RR#</th>
                                <th>MFR</th>
                                <th>Part Number</th>
                                <th>Part Name</th>
                                <th>Part Desc</th>
								<th>PO QTY</th>
								<th>DO QTY</th>
                                <th>UM</th>
                              
                             
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">

$('#filter').click(function() {
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        var itemProduct = $('#itemProduct').val();

        console.log(from_date,to_date,itemProduct)
        if (from_date != '' && to_date != '') {
            $('#transaction_inventory_list').DataTable().clear().destroy();
            load_data(from_date, to_date, itemProduct);
        } else {
            alert('Both Date is required');
        }
    });

$('#toggle').click(function () {
    //check if checkbox is checked
    if ($(this).is(':checked')) {
        
     
        $('#searchProduct1').attr('disabled', true); //disable input
        $("#itemProduct").val('0');
        $("#searchProduct1").val(''); //enable input
        
    } else {
        $('#searchProduct1').removeAttr('disabled');
      
    }
});
$(function () {
	var engine = new Bloodhound({
            remote:{

               
				url: "{{ URL::to('/po-do-dt?term=%QUERY%') }}",
               
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchProduct1").typeahead({
            hint: true,
            highlight: true,
            minLength:5
            }, 
            {
                source: engine.ttAdapter(),
                 displayKey: 'po_number',
                 limit:20,
                templates: {
                    empty: [
                        '<div class="empty-message">unable to find any</div>'
                    ],
                                suggestion: function (data) 
                                {
                                     return '<li id="suggestion">' + data.po_number +data.po_number_seq+ ' - '+ data.do_num +' '+ data.supplier +'</li>'
                                }

                }

         });
        $('#searchProduct1').on('typeahead:selected', function (e, datum) {
            $('#transaction_inventory_list').DataTable().clear().destroy();
             $("#po_date").val(datum.po_date);
            $("#po_id").val(datum.supplier);
            $("#rr_id").val(datum.po_number+datum.po_number_seq);
            $(function(){
		$("#transaction_inventory_list").DataTable({
            processing: true,
               serverSide: true,
            dom: 'Bfrtip',
            searching: false,
            paging: false,
  
 
    buttons: [
             'csv', 'pdf','excel'
        ],
            "ajax": {
                "url":"/po-do-list/"+datum.po_id,
                'type':"get",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
            }
            , columns:[ 
            {
                data: "do_num"
            },
            {
                data: "do_date"
            },
            {
                data: "rr_num"
            },
            {
                data: "mfr"
            },
            {
                data: "part_num"
            },
            {
                data: "part_name"
            },
            {
                data: "part_desc"
            },
            {
                data: "po_qty"
            },
            {
                data: "do_qty"
            },
            {
                data: "um"
            },
           
           
             ],
   
        })
	});
        });
});


		
	
</script>
@endsection
