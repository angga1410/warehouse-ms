@extends('layout.admin.base')
@section('stylesheet')
<style>
.modal-lg {
    max-width: 80%!important;
}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="materialRequest">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">MR/DO List</h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                    <a href="{{url('/new-material-request')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Material Request</span>
                    </span>
                </a>
                <a href="{{url('/new-do')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill float-left" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New DO</span>
                    </span>
                </a>
                    </div>
                </div>
               
            </div>
            <div class="card">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">Material Request</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="#history" role="tab" aria-controls="history" aria-selected="false">DO</a>
            </li>
           
          </ul>
        </div>
       
     
      </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
            <div class="card-body">
         
         
          
           <div class="tab-content mt-3">
            <div class="tab-pane active" id="description" role="tabpanel">
            <h4 class="card-title">Material Request List</h4>
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="material_request">
                        <thead>
                            <tr>
                                <th>Request No.</th>
                                <th>MR Name</th>
                                <!-- <th>Reference Type</th> -->
                                <th>Source Type</th>
                                <!-- <th>Source Name</th> -->
                                <th>Requester</th>
                                <th>MR Date</th>
                                <th>IS Approve</th>
                                <th>Status</th>
                                <th style="width: 50px;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
             
            <div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">  
            <h4 class="card-title">DO List</h4>
            <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="do">
                        <thead>
                            <tr>
                                <th>Request No.</th>
                                <th>MR Name</th>
                                <!-- <th>Reference Type</th> -->
                                <th>Source Type</th>
                                <!-- <th>Source Name</th> -->
                                <th>Requester</th>
                                <th>MR Date</th>
                                <th>IS Approve</th>
                                <th>Status</th>
                                <th style="width: 50px;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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

$('#bologna-list a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
    $(function(){
        $("#material_request").DataTable({
            "processing": true,
            "serverSide": true,
             ajax: {
                'url':"/material-request-dt", 
                'type':"post",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[ 
            {
                data: "id"
            },
            {
                data: "mr_name"
            },
            // {
            //     data: function(data){
            //         if(data.reference_type == 'internal_department')
            //         {
            //             return "Internal";
            //         }else if(data.reference_type == 'dispatch_order'){
            //             return "External";
            //         }
            //     }
            // },
            {
                data: "source_type"
            },
            // {
            //     data: function(data){
            //         return data.supplier.name
            //     }
            // },
            {
                data: "requester_id"
            }
            , {
                data: "created_at"
            },
            {
                data: function(data){
                    if(data.is_approve == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Pending</span>';
                    }else if(data.is_approve == 1)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Approve</span>';
                    }
                    else if(data.is_approve == 2){
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Reject</span>';
                    }
                }
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">processing</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--info m-badge--wide m--font-light">pick</span>';
                    }
                    else if(data.status == 2){
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Sent</span>';
                    }
                    else if(data.status == 3){
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Received</span>';
                    }
                }
            },
            {
                
                data: function(data){
                    return '<a href="/edit-material-request/'+data.id+'" style="text-decoration: none;" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
             ],
            "drawCallback":function(setting){
                $("#material_request .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#material_request').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-mr",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        
                        alert("Successfully User Deleted.");
                        $("#material_request").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
         }
        })
    });

    $(function(){
        $("#do").DataTable({
            "processing": true,
            "serverSide": true,
             ajax: {
                'url':"/do-dt", 
                'type':"post",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[ 
            {
                data: "id"
            },
            {
                data: "mr_name"
            },
            // {
            //     data: function(data){
            //         if(data.reference_type == 'internal_department')
            //         {
            //             return "Internal";
            //         }else if(data.reference_type == 'dispatch_order'){
            //             return "External";
            //         }
            //     }
            // },
            {
                data: "source_type"
            },
            // {
            //     data: function(data){
            //         return data.supplier.name
            //     }
            // },
            {
                data: "requester_id"
            }
            , {
                data: "created_at"
            },
            {
                data: function(data){
                    if(data.is_approve == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Pending</span>';
                    }else if(data.is_approve == 1)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Approve</span>';
                    }
                    else if(data.is_approve == 2){
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Reject</span>';
                    }
                }
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">processing</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--info m-badge--wide m--font-light">pick</span>';
                    }
                    else if(data.status == 2){
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Sent</span>';
                    }
                    else if(data.status == 3){
                       return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Received</span>';
                    }
                }
            },
            {
                
                data: function(data){
                    return '<a href="/edit-material-request/'+data.id+'" style="text-decoration: none;" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
             ],
            "drawCallback":function(setting){
                $("#material_request .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#material_request').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-mr",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        
                        alert("Successfully User Deleted.");
                        $("#material_request").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
         }
        })
    });
</script>
@endsection
