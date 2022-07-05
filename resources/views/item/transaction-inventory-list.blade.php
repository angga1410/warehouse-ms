@extends('layout.admin.base')
@section('stylesheet')


@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="transactionInventory">
@include('flash::message')
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator">Transaction Inventory List</h3>
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
                <div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
                    <div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>All Items ?</b></label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" id="toggle" value="0"  type="checkbox">
						</div>
					</div>
					</div>
				</div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
                    <div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>Search Items</b></label>
			    		<div class="m-typeahead">
							<input class="form-control m-input" style="width: 700px;" id="searchProduct1" type="text" dir="ltr" placeholder="Search Product">
						</div>
					</div>
					</div>
				</div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
                    <div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>From Date</b></label>
						<div class="m-typeahead">
			    	<input class="form-control" type="date" name="from_date" id="from_date">
					
						</div>
					</div>
					</div>
				</div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
                    <div class="form-group m-form__group">
						<label for="exampleInputEmail1"><b>To Date</b></label>
						<div class="m-typeahead">
                        <input class="form-control" type="date" name="to_date" id="to_date">
						</div>
					</div>
					</div>
				</div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               
						<button class="btn btn-primary" name="filter" id="filter">Search</button>
				
				</div>
                <input id="itemProduct" type="hidden" name="itemProduct">
                </div>
				<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
					<table class="table table-striped- table-bordered table-hover table-checkable" id="transaction_inventory_list">
						<thead>
							<tr>
								<th>Id</th>
                                <th>MFR</th>
                                <th>Part Number</th>
                                <th>Part Name</th>
                                <th>Part Desc</th>
								<th>Transaction Type</th>
                                <th>Warehouse</th>
								<th>Invantory Location</th>
								<th>Qty In</th>
                                <th>Qty Out</th>
								<th>Date</th>
                                <th>Action</th>
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

               
				url: "{{ URL::to('/products-data?term=%QUERY%') }}",
               
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchProduct1").typeahead({
            hint: true,
            highlight: true,
            minLength:3
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
                                     return '<li id="suggestion">' + data.part_num +' - '+data.mfr +'- '+data.part_name +'- '+data.part_desc +'</li>'
                                }

                }

         });
        $('#searchProduct1').on('typeahead:selected', function (e, datum) {
            // $("#btn_qc").show();
			console.log("ok")
            $("#itemProduct").val(datum.id);
        });
});
function load_data(from_date = '', to_date = '',itemProduct ='') {
    console.log(from_date,to_date,itemProduct)
    $("#transaction_inventory_list").DataTable({
			"processing": true,
        	"serverSide": true,
           paging: false,
            "ajax": {
                "url":"/transaction-inventory-dt",
                'type':"post",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
                'data': {
                    from_date: from_date,
                    to_date: to_date,
                    itemProduct : itemProduct
                },
            },
           
             columns:[ 
            {
                data: "id"
            },
            {
                data: function(data){
                    return data.inventory.products.mfr
                }
            },
            {
                data: function(data){
                    return data.inventory.products.part_num
                }
            },
            {
                data: function(data){
                    return data.inventory.products.part_name
                }
            },
            {
                data: function(data){
                    return data.inventory.products.part_desc
                }
            },
            {
                data: "txn_type"
            },
            {
                data: function(data){
                    if(data.inventory.warehouse.wh_id == 20){
                        return "1.GUDANG BAGUS"
                    }if(data.inventory.warehouse.wh_id == 21){
                        return "6.GUDANG SUPPLIES"
                    }if(data.inventory.warehouse.wh_id == 22){
                        return "10.GUDANG RECONDITION"
                    }if(data.inventory.warehouse.wh_id == 23){
                        return "GD1-COMP ASS NEW"
                    }
                    if(data.inventory.warehouse.wh_id == 24){
                        return "5.GUDANG TITIPAN"
                    }else{
                        return ""
                    }
                    
                }
            },
            {
                data: function(data){
                    return data.inventory.warehouse.wh_name
                }
            },
            {
                data: "qty_in"
            },
            {
                data: "qty_out"
            },
            {
                data: "created_at"
            },
            {
               data: function(data){
                    return '<a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
            
             ],
            "drawCallback":function(setting){
                $("#transaction_inventory_list .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#transaction_inventory_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-transaction-inventory",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        
                        alert("Successfully Transaction Inventory Deleted.");
                        $("#transaction_inventory_list").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
         }
        })
}

		
	
</script>
@endsection
