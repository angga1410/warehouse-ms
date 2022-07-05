@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="receiveDocument">
    @include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Receive Document</h3>
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
                <a href="{{url('/new-receive-document')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Receive Document</span>
                    </span>
                </a>
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="receive_document">
                        <thead>
                            <tr>
                                <th>PO No.</th>
                                <th>Reference DO Vendor</th>
                                <th>Reference Type</th>
                                <th>Sender Name</th>
                              

                                <!-- <th>Source Name</th>
                                <th>Mover Name</th> -->
                                <!-- <th>Item Linked</th> -->
                                <th>Status</th>
                                <!-- <th>Is Verified</th> -->
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
    $(function() {
        $("#receive_document").DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                'url': "/receivedocument-dt",
                'type': "post",
                'headers': {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [{
                    data: "document_no"
                },
                {
                    data: "reference_rr"
                }, 
                {
                    data: "reference"
                },
                {
                    data: "sender_name"
                },
                // , {
                //     data: function(data){
                //         return data.supplier.name
                //     }
                // }

                // , {
                //     data: function(data){
                //         if(data.item_linked == 1){
                //             return "Yes";
                //         }else{
                //             return "No";
                //         }
                //     }
                // },
                {
                    data: function(data) {
                        if (data.status == 0) {
                            return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Queue</span>';
                        } else if (data.status == 1) {
                            return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Qc Request</span>';
                        } else if (data.status == 2) {
                            return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Received Report</span>';
                        }

                    }
                }
                // {
                //     data: function(data){
                //         if(data.is_verified == 0)
                //         {
                //            return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Pending</span>';
                //         }else if(data.is_verified == 1)
                //         {
                //            return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Ok</span>';
                //         }else if(data.is_verified == 2){
                //             return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Defect</span>';
                //         }

                //     }
                // }
                , {
                    data: function(data) {
                        return '<a href="/edit-receive-document/' + data.id + '" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a>' ;
                            // '<a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                    }
                }
                // ]   , columnDefs:[{
                //     targets:2, render:function(data) {
                //         return null;
                //     }
                // }
            ],
            "drawCallback": function(setting) {

                $("#receive_document .delete").on("click", function(e) {
                    e.preventDefault();
                    var input = $('#receive_document').DataTable().row($(this).parents('tr')).data();
                    $.ajax({
                        url: "/delete-receive-document",
                        method: "post",
                        data: {
                            'id': input.id,
                            '_token': $("#token").val()
                        },
                        success: function(data) {

                            alert("Successfully Document Deleted.");
                            $("#receive_document").DataTable().draw();
                        },
                        error: function(data) {
                            alert("There is some internal error");
                        }
                    });
                });
            }
        })
    });
</script>
@endsection