@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper">

          <!-- BEGIN: Subheader -->
          <div class="m-subheader ">
            <div class="d-flex align-items-center">
              <div class="mr-auto">
                <h3 class="m-subheader__title ">Receive Dashboard</h3>
                <div class="row">

            <!-- Earnings (Monthly) Card Example -->
         
            <div class="col-xl-3 col-md-6 mb-4">
           
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body"> 
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Queue Documents &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">{{$countQueue}}</div></span></div>
                      <a href="{{url('/queue-list')}}">
                      <img src="{{url('/image/doc.png')}}" width="30%"  class="center">
                      </a>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/queue-list')}}" class="btn btn-primary stretched-link">View</a>
                    </div>
                    <div class="col-auto">
                   
                    </div>
                  </div>
                </div>
              </div>
          
            </div>
         
         <div class="col-xl-3 col-md-6 mb-4">
           
           <div class="card border-left-primary shadow h-100 py-2">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Inspection &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">{{$countQueue}}</div></span></div>
                   <a href="#">
                   <img src="{{url('/image/check.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/inspection-document')}}" class="btn btn-primary stretched-link">View</a>
                 </div>
                 <div class="col-auto">
               
                 </div>
               </div>
             </div>
           </div>
       
         </div>
         <div class="col-xl-3 col-md-6 mb-4">
           
           <div class="card border-left-primary shadow h-100 py-2">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Quality Check &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">{{$countQC}}</div></span></div>
                   <a href="#">
                   <img src="{{url('/image/qc.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/qc-request-list')}}" class="btn btn-primary stretched-link">View</a>
                 </div>
                 <div class="col-auto">
               
                 </div>
               </div>
             </div>
           </div>
       
         </div>
    
         <div class="col-xl-3 col-md-6 mb-4">
           
           <div class="card border-left-primary shadow h-100 py-2">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Receiving Report &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">{{$countRR}}</div></span></div>
                   <a href="#">
                   <img src="{{url('/image/rr.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('/report-list')}}" class="btn btn-primary stretched-link">View</a>
                 </div>
                 <div class="col-auto">
               
                 </div>
               </div>
             </div>
           </div>
       
         </div>
         <div class="col-xl-3 col-md-6 mb-5">
           
           <div class="card border-left-primary shadow h-100 py-2">
             <div class="card-body">
               <div class="row no-gutters align-items-center">
                 <div class="col mr-2">
                   <div class="text-xs font-weight-bold text-uppercase mb-1">Send Item to Warehouse &nbsp;&nbsp;&nbsp;&nbsp; <span class="badge badge-danger badge-pill" ><div class="h5 mb-0 font-weight-bold text-gray-800">{{$countSWH}}</div></span></div>
                   <a href="#">
                   <img src="{{url('/image/sent.png')}}" width="30%"  class="center">
                   </a>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="{{url('senditems-towh-list')}}" class="btn btn-primary stretched-link">View</a>
                 </div>
                 <div class="col-auto">
               
                 </div>
               </div>
             </div>
           </div>
       
         </div>
         

        <!-- Content Row -->

        <div class="col col-lg-7">
        </div>

<!-- Area Chart -->


<!-- Pie Chart -->


  </div>
</div>
</div>

<!-- END: Subheader -->
<div class="m-content">
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
   
</script>
@endsection
