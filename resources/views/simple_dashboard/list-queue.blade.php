@extends('layout.admin.base')

@section('body')
<style>

table.dataTable td {
  font-size: 1.4em;
}

</style>
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="receiveDocument">
    @include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Purchase Order Today's</h3><br>
                <h3 class="m-subheader__title m-subheader__title--separator">{{date('d M Y ')}}</h3>
            </div>
        </div>
    </div>
    <div class="m-content">
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="font-weight: bold;">Add to Queue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{url('/add-new-receive-document')}}" enctype='multipart/form-data' id="document_form">
					<div class="row">
					<div class="col-sm-12">
					  <div class="row">
						<div class="col-sm-4">
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
							<input type="hidden" name="queue_id" class="queue_id">
							{!! csrf_field() !!}
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Purchase Order No.</label>
								<input class="form-control m-input m-input--square documents" name="document_no" required="true" id="document_no" >
								
							
							</div>
						
								
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1" style="font-weight: bold;">Reference DO Vendor</label>
								<input type="text" class="form-control m-input" name="reference_rr" required="true">
							</div>

							<div class="form-group m-form__group">
									
										<input type="hidden" class="form-control m-input reference_id" name="po_id" style="border: none;" required="true">
									</div>
									<div class="form-group m-form__group">
									<input type="hidden" class="form-control m-input source" name="source_id" style="border: none;" required="true">
							
								</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1">Reference</label>
								<select class="form-control m-input m-input--square" name="reference" required="true">
								<option value="internal">Internal</option>
								</select>
							</div>
                            <div class="form-group m-form__group">
									<label for="exampleInputEmail1" style="font-weight: bold;">Assign to</label>
									<select class="form-control m-input m-input--square" name="assign_to" required="true">
									<option value="">Select Employee</option>
									@foreach($users as $user)
										<option value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
									</select>
								</div>
							
						</div>
							<!-- <div class="m-radio-inline">
							<label>Item Linked? </label>
								<label class="m-radio">
									<input type="radio" name="item_linked" checked="true" value="1">Yes 
									<span></span>
								</label>
								<label class="m-radio">
									<input type="radio" name="item_linked" value="0"> 
									No
									<span></span>
								</label>
							</div> -->
						<div class="col-sm-4">
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1" style="font-weight: bold;">Source</label>
								<select class="form-control m-input m-input--square" name="source" required="true">
								<option value="external">External</option>
								</select>
							</div>
							<!-- <div class="form-group m-form__group">
								<label for="exampleInputEmail1">Source Type</label>
								<select class="form-control m-input m-input--square source_type" name="source_type" required="true">
								<option value="">Select Source Type</option>
								<option value="supplier">Supplier</option>
								</select>
							</div> -->
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1" style="font-weight: bold;">Supplier Name</label>
								<input type="text" class="form-control m-input site" name="source_name"  required="true" readonly>
								<!-- <input type="text" class="form-control m-input" name="source_name" required="true"> -->
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1" style="font-weight: bold;">Send Via Mover</label>
								<select class="form-control m-input m-input--square " name="mover_id" required="true">
								<option value="">Select Mover</option>
								@foreach($movers as $mover)
									<option value="{{$mover->id}}">{{$mover->name}}</option>
								@endforeach
							
								</select>
								<!-- <input type="text" class="form-control m-input" name="source_name" required="true"> -->
							</div>
							<div class="form-group m-form__group">
									<label for="exampleInputEmail1" style="font-weight: bold;">Send via Employee</label>
									<select class="form-control m-input m-input--square" name="employee_id" required="true">
									<option value="">Select Employee</option>
									@foreach($users as $user)
										<option value="{{$user->id}}">{{$user->name}}</option>
									@endforeach
									</select>
								
								</div>
							
						
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1" style="font-weight: bold;">Attach Pics.</label>
								<input type="file" class="m-input" name="attach_pic">
							</div>
						</div>
                        <div class="col-sm-4">
                        <div class="form-group m-form__group">
								<label for="exampleInputEmail1" style="font-weight: bold;">Sender Name</label>
								<input type="text" class="form-control m-input" name="sender_name" required="true">
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1" style="font-weight: bold;">Sender Phone</label>
								<input type="text" class="form-control m-input" name="sender_phone" required="true">
							</div>
							<div class="form-group m-form__group">
								<label for="exampleInputEmail1" style="font-weight: bold;">Arrival Status</label>
								<select class="form-control m-input m-input--square" name="partial_status" required="true">
								<option value="1">All</option>
								<option value="2">Partial</option>
								</select>
							</div>
							<div class="m-radio-inline">
								<label class="m-radio">
									<input type="radio" name="document_via" value="direct_from_source" checked="true">Direct Form Source 
									<span></span>
								</label>
								<label class="m-radio">
									<input type="radio" name="document_via" value="via_mover"> 
									Via Mover
									<span></span>
								</label>
							</div><br>
                      
							
                        </div>
                        <div class="col-sm-12">
                        <div class="form-group m-form__group">
								<label for="exampleInputEmail1" style="font-weight: bold;">Remark</label>
								<textarea rows="2" class="form-control m-input" name="remark" required="true"></textarea>
							</div>
                        </div>
					  </div>
						<!-- <div class="form-group m-form__group text-center">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div> -->
					</div>
					</div>
				
                    <table class="table m-table m-table--head-bg-metal new_raw_qc m--margin-top-20" id="new_raw_qc">
						<thead>
					        <tr style="font-weight: bold; color: black;">
					          <th>Product Id</th>
					          <th>Mfr.</th>
					          <th>Product Number</th>
					          <th>Part Name</th>
							  <th>Description</th>
							  <th>Qty Order</th>
							
					          <th>Qty Balance</th>
					          <th>U/M</th>
					         
					        </tr>
					    </thead>
					    <tbody>
					       
					    </tbody>
				        </table>
      </div>
   
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                        </h3>
                    </div>
                </div>
               
                <a href="{{url('/new-receive-document')}}" >
                <button class="btn btn-primary">
              
  Add New Queue
</button>
</a>
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                <table class="table table-striped- table-bordered table-hover table-checkable" style="width: 100%;" id="receive_document">
                        <thead>
                            <tr style="background-color: #1e4d77; color:white;">
                            <th>Vendor</th>
                                <th>PO No.</th>
                                <!-- <th>Estimate Date</th> -->
                                <th>Remark</th>
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
    load2();
function load2(){
    $(function() {
      $('#receive_document').DataTable().clear().destroy();
      console.log("test")
        $("#receive_document").DataTable({
            "processing": true,
            "serverSide": true,
            "paging":   false,
        "ordering": false,
        "info":     false,
        "searching" : false,
            ajax: {
                'url': "/receivedocument-dt1",
                'type': "post",
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [   {
                data: function(data){
                    return data.supplier.supplier_name
                }
            }, {
                data: function(data){
                    return data.po_number+data.po_number_seq
                }
            },
          
                {
                    data: "remark"
                },
             
                {
                
                data: function(data){
                    return '<a  onclick="load3('+data.id+')" data-toggle="modal" data-target=".bd-example-modal-lg" style="text-decoration: none;" class="btn btn-outline-brand">Add to Queue</a> ';
                }
            },
            ],
            
        })
    });
  }

 function load3(poID){
    
    $.ajax({
        type:"get",
        url: "po/"+poID,
        success: function(data) { 
            
            $(".documents").val(data.po_number+data.po_number_seq);
            $(".reference_id").val(data.id);
		  $.ajax({
        type:"get",
        url: "sup/"+data.supplier_id,
		success: function(data2) { 
			console.log(data2);
			$.each(data2, function () {
				$(".site").val(data2.supplier_name);
				$(".source").val(data2.id);
				console.log(data.supplier_id);
	        });
		}
		  });
		 
        
        }
      });
    $('#new_raw_qc').DataTable().clear().destroy();
        $.ajax({
		type:"get",
		url: "/po-data2/"+poID,
		success: function(data) {
		   //console.log(data);
		$.each(data, function (index, datum) {
			console.log(datum);
		  $("#new_raw_qc").append('<tr class="qc-tr">'+
		  '<input type="hidden" name="qty_balance[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_pos+'" >'+
		  '<input type="hidden" name="po_detail_id[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.id+'" >'+
				  '<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.products.id+'" readonly="true" style="width:75px;border:none;"></td>'+
				  '<td>'+datum.products.mfr+'</td>'+
				'<td>'+datum.products.part_num+'</td>'+
				'<td>'+datum.products.part_name+'</td>'+
				'<td>'+datum.products.part_desc+'</td>'+
				'<td>'+datum.qty_pos+'</td>'+
			
				'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" readonly="true" value="'+datum.qty_delivered+'" ></td>'+
				
				'<td>'+datum.um_pos+'</td>'+
				
				  '</tr>');
			// $("#new_raw_qc").append('<tr class="qc-tr">'+
			// 	'<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
			// 	'<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
			// 	'<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.description+'" readonly="true" style="width:75px;border:none;"></td>'+
			// 	'<td><input type="text" name="qty_receive[]" class="form-control m-input qty_qc" style="width: 100px;" value="'+datum.qty_qc+'"  required="true"></td>'+
			// 	'<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.um+'" style="width:75px;border:none;"></td>'+
			// 	'</tr>');
		  //   	if(type == 'qc_pass'){
				// 	$(".qty"+index).val(datum.qty_qc);
				// }else{
				// 	console.log(datum.qty_po);
				// 	$(".qty"+index).val(datum.qty_po);
				// }
			});
		}
	 });
  }
</script>
@endsection