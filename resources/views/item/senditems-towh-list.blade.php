@extends('layout.admin.base')

@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="sendItemsToWH">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Send Items To Warehouse List</h3>
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
                <a href="{{url('/sendItem-toWarehouse')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Send Items To WH</span>
                    </span>
                </a>
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="send_items_to_wh">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>RR Number</th>
                                <th>Sender</th>
                                <th>Hand-Over-By</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th style="width:80px;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="m_modal_senditems_towh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group table-responsive">
                    <table class="table table-bordered m-table senditems_towh"> 
                        <tr>
                          <th>Id</th>
                          <th class="first">Mfr.</th>
                          <th>Product Number</th>
                          <th class="second">Part Name</th>
                          <th class="third">Description</th>
                          <th class="fourth">Qty Send</th>
                          <th class="fifth">U/M</th> 
                          <!-- <th>Warehouse</th>
                          <th>Location</th> -->
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    $(function(){
        $("#send_items_to_wh").DataTable( {
            "processing": true,
            "serverSide": true,
            ajax: {
                'url': '/senditems-towh-dt',
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
                 data: function(data){
                    return data.document.rr_num
                }
            },
            {
                 data: function(data){
                     if(data.sender.name != null){
                        return data.sender.name
                     }else{
                        return " ";
                     }
                    
                }
            },
            {
                 data: function(data){
                    return data.user.name
                }
            },
            {
                data: "created_at"
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Processing</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--info m-badge--wide m--font-light">Recevie Items</span>';
                    }else if(data.status == 2)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Store Warehouse</span>';
                    }
                    
                }
            },
            // {
            //     data: function(data){
            //         if(data.is_verified == 0)
            //         {
            //            return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Pending</span>';
            //         }else if(data.is_verified == 1)
            //         {
            //            return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Approve</span>';
            //         }else if(data.is_verified == 2){
            //              return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Reject</span>';
            //         }
                    
            //     }
            // },
            {
                
                data: function(data){
                    return '<a style="text-decoration: none;" href="#" data-toggle="modal" data-target="#m_modal_senditems_towh" class="view btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-eye"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
    
            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
             ],
            "drawCallback":function(setting){

            $("#send_items_to_wh .view").on("click",function(e){
                $(".senditemswh_detail_tr").empty();
                e.preventDefault();
                var input = $('#send_items_to_wh').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/senditems-towh-detail/"+input.receive_report_id,
                    method:"get",
                    success:function(data){
                       
                        $.each( data, function( key, value ) {
                          
                          $(".senditems_towh").append('<tr class="senditemswh_detail_tr"><td>'+value.products.id+'</td><td>'+value.products.mfr+'</td><td>'+value.products.part_num+'</td> <td>'+value.products.part_name+'</td><td>'+value.products.part_desc+'</td> <td>'+value.qty_receive +'</td> <td>'+value.products.default_um+'</td> </tr>');
                        });
                        
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });

            $("#send_items_to_wh .delete").on("click",function(e){
                e.preventDefault();
                var input = $('#send_items_to_wh').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/delete-senditems-towh",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Send Items To Warehouse Deleted.");
                        $("#send_items_to_wh").DataTable().draw();
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            // $("#send_items_to_wh .edit").on("click",function(e){
            //     e.preventDefault();
            //     var input = $('#send_items_to_wh').DataTable().row($(this).parents('tr')).data();
            //     $.ajax({
            //         url:"/edit-qcRequest",
            //         method:"post",
            //         data:{'id':input.id,'_token':$("#token").val()},
            //         success:function(data){
            //             alert("Successfully Change Status.");
            //             $("#send_items_to_wh").DataTable().draw();
            //         },
            //         error:function(data){
            //             alert("There is some internal error");
            //         }
            //     });
            // });
            // <td class="warehouse_send_item"></td>'+
            // '<td class="location_send_item"></td>

            // var warehouses_array = <?php echo json_encode($warehouses); ?>;
            //             jQuery.each(warehouses_array,function( i, warehouse){
            //               if(value.warehouse == warehouse.id)
            //               {
            //                 $(".warehouse_send_item").text(warehouse.name);
                            
            //                 jQuery.each(warehouse.warehouse_location,function( i, location){
            //                     if(value.location_rack == location.id){
            //                         $(".location_send_item").text(location.location);
            //                     }
            //                 });
            //               }
            //             });
            }
        });
    });
</script>
@endsection
