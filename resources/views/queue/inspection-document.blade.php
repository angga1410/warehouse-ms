@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="receiveDocument">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Outstanding Inspection Document</h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                        </h3>
                    </div>
                </div>
                <a href="{{url('/inspection')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Inspection Document</span>
                    </span>
                </a>
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="inspection">
                        <thead>
                            <tr>

                                <!-- <th>Queue Id</th> -->
                                <th>Document No.</th>
                                <th>Remark</th>
                                <th>Date</th>
                              
                                <!-- <th>Is Verified</th> -->
                                <th style="width:80px;">Action</th>
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
    $(function(){
        $("#inspection").DataTable( {
            "processing": true,
            "serverSide": true,
             ajax: {
                'url':"/receivedocument-dt",
                'type':"post",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            }
            , columns:[
            // {
            //     data: "entry_queue_id"
            // },
            {
                data: "reference_rr"
            },
            {
                data: "remark"
            },
            {
                data: "created_at"
            },
         
         
            {

                data: function(data){
                    if (data.status == 0) {
                        return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Queue</span>';
                        } else {
                    return ' <a href="/edit-qcRequest/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a>';
                }
            }
            
            },

       
             ],
            "drawCallback":function(setting){

                $("#inspection .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#inspection').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-receive-document",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        
                        alert("Successfully Document Deleted.");
                        $("#inspection").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            }
        }
        )
    });
</script>
@endsection
