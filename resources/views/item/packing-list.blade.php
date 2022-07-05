@extends('layout.admin.base')
@section('stylesheet')
<style>
.modal-lg {
    max-width: 80%!important;
}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="packingItems">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Packing Items List</h3>
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
                <a href="{{url('/packing-items')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Packing Item</span>
                    </span>
                </a>
            </div>
            <input type="hidden" id="token" value="{{csrf_token()}}">
            <div class="m-portlet__body">
                <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
                    <table class="table table-striped- table-bordered table-hover table-checkable" id="packing_item_list">
                        <thead>
                            <tr>
                                <th>Packing Id</th>
                                <th>Reference No.</th>
                                <th>Do</th>
                                <th>Pack By</th>
                                <th>packing Date</th>
                                <th>Is Packed</th>
                                <th>Status</th>
                                <th>Complete Packing</th>
                                <th>View Detail</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="m_modal_pack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Qc Request Item Parts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group table-responsive">
                    <table class="table table-bordered m-table pack_item_tbl"> 
                        <tr>
                          <th>Id</th>
                          <th class="first">Mfr.</th>
                          <th>Product Number</th>
                          <th class="second">Part Name</th>
                          <th class="third">Description</th>
                          <th class="fourth">Qty</th>
                          <th class="fifth">U/M</th> 
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
        $("#packing_item_list").DataTable({
            "processing": true,
            "serverSide": true,
             ajax: {
                'url':"/packing-items-dt", 
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
                data: "send_items_from_wh_id"
            },
            {
                data: function(data){
                    return data.do_user.name
                }
            },
            {
                data: function(data){
                    return data.pack_by_user.name
                }
            }
            , {
                data: "created_at"
            },
            {
                data: function(data){
                    if(data.is_packed == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Process</span>';
                    }else if(data.is_packed == 1)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Complete</span>';
                    }
                    
                }
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Pending</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Sent Do</span>';
                    }
                    
                }
            },
            {
                
                data: function(data){
                    return '<a href="#" style="text-decoration: none;" class="edit btn btn-outline-accent m-btn m-btn--icon btn-lg m-btn--icon-only m-btn--pill m-btn--air btn-sm"><i class="la la-check"></i></a>';
                }
            },
            {
                data: function(data){
                    return '<a style="text-decoration: none;" href="#" data-toggle="modal" data-target="#m_modal_pack" class="view btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-eye"></i></a>';
                }
            },
             ],
             "drawCallback":function(setting){

                $("#packing_item_list .view").on("click",function(e){
                $(".pack_detail_tr").empty();
                e.preventDefault();
                var input = $('#packing_item_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/pack-data/"+input.id,
                    method:"get",
                    success:function(data){
                       
                        $.each( data, function( key, value ) {
                          
                          $(".pack_item_tbl").append('<tr class="pack_detail_tr"><td>'+value.products.id+'</td><td>'+value.products.mfr+'</td><td>'+value.products.part_number+'</td> <td>'+value.products.part_name+'</td><td>'+value.products.part_desc+'</td> <td>'+value.qty_pack+'</td> <td>'+value.products.default_um+'</td></tr>');
                         
                        });
                        
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
                $("#packing_item_list .edit").on("click",function(e){
                e.preventDefault();
                var input = $('#packing_item_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/edit-packing-items",
                    method:"post",
                    data:{'id':input.id,'_token':$("#token").val()},
                    success:function(data){
                        alert("Successfully Change Status.");
                        $("#packing_item_list").DataTable().draw();
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
