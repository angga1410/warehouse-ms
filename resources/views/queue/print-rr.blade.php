@extends('layout.admin.base')

@section('body')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
<a href="" class="btn btn-accent m-btn m-btn--air m-btn--custom" onclick="printDiv('printableArea')">PRINT</a>
<div id="printableArea">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
                        <div class="col-sm-8">
                            <img src="/image/logorr.png" width="70%">
                            <p class="mb-1"><span class="text-muted">PT. GRAHA SUMBER PRIMA ELEKTRONIK </span></p>
                            <p class="mb-1"><span class="text-muted">INTERCON PLAZA BLOK D11 </span></p>
                            <p class="mb-1"><span class="text-muted">JL. MERUYA ILIR, SRENGSENG-KEMBANGAN</p>
                            <p class="mb-1"><span class="text-muted">Phone  (62-21)7587-9949/51 </span></p>
                            <p class="mb-1"><span class="text-muted"> NPWP : 01.789.513.038.000  </span></p>
                        </div>

                        <div class="col-sm-4">
                      
                            <p class="font-weight-bold mb-1" value=""  onchange="location = this.value;"></p>
                           
                            <p class="text-muted">{{ date("Y-m-d H:i:s")}}</p>
                            <p class="font-weight-bold mb-1"><h2>RR REPORT</h2>  </p>
                            <table style="width:100%">
  <tr>
    <th>RR No.</th>
    <td>{{$reportLists->rr_num}}</td>
  </tr>
  <tr>
  <th>Do Date.</th>
    <td>{{$reportLists->created_at}}</td>
  </tr>
  <tr>
  <th>Do No.</th>
  @if($do->reference_do == null)
    <td>{{$reportLists->document->reference_rr}}</td>
    @else
    <td>{{$do->reference_do}}</td>
    @endif
  </tr>
  <tr>
  <th>Receive Date</th>
    <td>{{$reportLists->created_at}}</td>
  </tr>
  <tr>
  <th>Vendor Name</th>
    <td>{{$suppliers->supplier->supplier_name}}</td>
  </tr>
  <tr>
  <th>AWB No.</th>
    <td>-</td>
  </tr>
</table>
                        </div>
                        
                    </div>

                    <hr class="my-5">

                   

                    <div class="row p-5">
                        <div class="col-md-12">
                        <div class="row" id="m_user_profile_tab_1">



                        <table  class="table table-bordered m-table"  style="width:100%" > 
							<thead>
						        <tr>
						          <th class="first">Mfr.</th>
						          <th class="first">Part Number</th>
						          <th class="second">Part Name</th>
						          <th class="third">Description</th>
                                  <th class="seventh">Qty Delivered</th>
                                  <th class="eighth">U/M</th>
                                  <th class="eighth">Our PO No.</th>
                                  <th class="seventh">Order</th>
                                  <th class="seventh">Balance</th>
                                 
                                 
						        </tr>
						    </thead>
						    <tbody>
						     @foreach($reportLists->reportdetail as $reportList)
						        <!-- <tr>
						        <input type="hidden" name="detail_id[]" value="{{$reportList->id}}">
						          <td><input type="text" name="mfr[]" value="{{$reportList->mfr}}" class="form-control m-input mfr" style="width: 100px;border: none;" required="true" readonly></td>
						          <td><input type="text" name="product_number[]" value="{{$reportList->product_number}}" class="form-control m-input product_number" style="width: 100px;" required="true" readonly></td>
						          <td><input type="text" name="part_name[]" value="{{$reportList->part_name}}" class="form-control m-input part_name" required="true" readonly></td> 
						          <td><input type="text" name="description[]" value="{{$reportList->description}}" class="form-control m-input description" required="true"></td>
						          <td><input type="number" name="qty_receive[]" value="{{$reportList->qty_receive}}" class="form-control m-input qty_receive" style="width: 100px;" required="true"></td>
						          <td><input type="text" name="um[]" value="{{$reportList->um}}" class="form-control m-input um" style="width: 100px;" required="true"></td>
						        </tr> -->
						        <tr>
						         <input type="hidden" name="detail_id[]" value="{{$reportList->id}}">
						        <td>{{$reportList->products->mfr}}</td>
						        <td>{{$reportList->products->part_num}}</td>
						        <td>{{$reportList->products->part_name}}</td>
						        <td>{{$reportList->products->part_desc}}</td>
                                <td>{{$reportList->qty_receive}}</td>
                              
                                <td>{{$reportList->products->default_um}}</td>
                             
                                <td>{{$reportList->po->document->document_no}}</td>
                                
                                @foreach($pod as $podd)
                               @if($podd->id == $reportList->po_detail_id)
                               <td>{{$podd->qty_pos}}</td>
                               <td>{{$podd->qty_delivered}}</td>
                                @endif
                               
                                @endforeach
                                @endforeach
                              
						        </tr>
						
						    </tbody>
					       </table>
</div>
                        </div>
                    </div>

                  
                    <div class="col-md-6">
                    <p class="mb-1"><span class="text-muted">Remark :</span></p>
                    {{$reportLists->remark}}
                    <p class="mb-1"><span class="text-muted">Note :</span></p>
                            <p class="mb-1"><span class="text-muted">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span></p>
                            <p class="mb-1"><span class="text-muted"> </span></p>
                            <p class="mb-1"><span class="text-muted"> </span></p>
                           
                        </div>
                        <br>
                       
                        <div class="row">
    <div class="col-sm">
    <p class="text-center">  PREPARED BY : 
    </div>
    <div class="col-sm">
    <p class="text-center">  APPROVED BY : 
    </div>
    <div class="col-sm">
     
    </div>
  </div>
  <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                </div>
            </div>
        </div>
    </div>
    
   

</div>
</div>



</div>
@endsection
@section('script')
<script type="text/javascript">
function printDiv(divName) {
  
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

</script>
@endsection
