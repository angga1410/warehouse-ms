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
                           
                        </div>

                        <div class="col-sm-4">
                      
                            <p class="font-weight-bold mb-1" value=""  onchange="location = this.value;"></p>
                           
                            <p class="text-muted">{{ date("Y-m-d H:i:s")}}</p>
                            <p class="font-weight-bold mb-1"><h2>Transaction Inventory Report</h2>  </p>
                            <table style="width:100%">
  <!-- <tr>
    <th></th>
    <td></td>
  </tr>
  <tr>
  <th>Do Date.</th>
    <td></td>
  </tr>
  <tr>
  <th>Do No.</th>
  
  </tr>
  <tr>
  <th>Receive Date</th>
    <td></td>
  </tr>
  <tr>
  <th>Vendor Name</th>
    <td></td>
  </tr>
  <tr>
  <th>AWB No.</th>
    <td>-</td>
  </tr> -->
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
                              
                                 
						        </tr>
						    </thead>
						    <tbody>
						     @foreach($tr as $reportList)
						      
						        <tr>
						        
                                 <td>{{$reportList->inventory->products->id}}</td>
						        <td>{{$reportList->inventory->products->mfr}}</td>
						        <td>{{$reportList->inventory->products->part_num}}</td>
						        <td>{{$reportList->inventory->products->part_name}}</td>
						        <td>{{$reportList->inventory->products->part_desc}}</td>
                                <td>{{$reportList->txn_type}}</td>
                               
                                <td>{{$reportList->inventory->warehouse->warehouse->name}}</td>
                                <td>{{$reportList->inventory->warehouse->wh_name}}</td>
                                <td>{{$reportList->qty_in}}</td>
                                <td>{{$reportList->qty_out}}</td>
                                <td>{{$reportList->created_at}}</td>
                              
                                @endforeach
                              
						        </tr>
						
						    </tbody>
					       </table>
</div>
                        </div>
                    </div>

                  
                    <!-- <div class="col-md-6">
                    <p class="mb-1"><span class="text-muted">Remark :</span></p>
                
                    <p class="mb-1"><span class="text-muted">Note :</span></p>
                            <p class="mb-1"><span class="text-muted">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </span></p>
                            <p class="mb-1"><span class="text-muted"> </span></p>
                            <p class="mb-1"><span class="text-muted"> </span></p>
                           
                        </div> -->
                        <br>
                       
                        <!-- <div class="row">
    <div class="col-sm">
    <p class="text-center">  PREPARED BY : 
    </div>
    <div class="col-sm">
    <p class="text-center">  APPROVED BY : 
    </div>
    <div class="col-sm">
     
    </div>
  </div> -->
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
