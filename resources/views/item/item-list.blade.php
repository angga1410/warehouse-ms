@extends('layout.admin.base')
@section('stylesheet')
<style>
.modal-lg {
    max-width: 80%!important;
}
</style>
@endsection
@section('body')
<div class="m-grid__item m-grid__item--fluid m-wrapper" id="itemList">
@include('flash::message')
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">Item List</h3>
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
                <a href="{{url('/new-item')}}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="height: 40px;margin-top: 11px;">
                    <span>
                        <i class="la la-cart-plus"></i>
                        <span>New Item</span>
                    </span>
                </a>
            </div>
            <div class="m-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="item_list">
                    <thead>
                        <tr>
                            <th>Item No.</th>
                            <th>Document No.</th>
                            <th>Reference</th>
                            <th>Source Type</th>
                            <th>Source Name</th>
                            <th>Receiver</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th style="width: 80px;">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade " id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group table-responsive">
                    <table class="table table-bordered m-table item_parts_tbl"> 
                    <tr>
                      <th class="first">Mfr.</th>
                      <th class="second">Part Name</th>
                      <th class="third">Description</th>
                      <th class="seventh">Qty Receive</th>
                      <th class="eighth">U/M</th>
                      <th class="eighth">Warehouse</th>
                      <th class="eighth">Location\Rack</th>
                    </tr>
                   
                   
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(function(){
        
        $("#item_list").DataTable({
            "processing": true,
            "serverSide": true,
             ajax: {
                'url':"/dt/itemlist", 
                'type':"post",
                'headers':{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns:[ 
            {
                data: "id"
            },
            {
                data: "document_no"
            },
            {
                data: "reference"
            },
            {
                data: "source_type"
            },
            {
                data: "source_name"
            },
            {
                data: function(data){
                    return data.user.name
                }
            }
            , {
                data: "created_at"
            },
            {
                data: function(data){
                    if(data.status == 0)
                    {
                       return '<span class="m-badge m-badge--warning m-badge--wide m--font-light">Processing</span>';
                    }else if(data.status == 1)
                    {
                       return '<span class="m-badge m-badge--info m-badge--wide m--font-light">Sent</span>';
                    }else if(data.status == 2){
                        return '<span class="m-badge m-badge--danger m-badge--wide m--font-light">Received</span>';
                    }else if(data.status == 3){
                        return '<span class="m-badge m-badge--success m-badge--wide m--font-light">Store</span>';
                    }
                    
                }
            },
            {
                
                data: function(data){
                    return '<a href="#" style="text-decoration: none;" data-toggle="modal" data-target="#m_modal_1" class="view btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-eye"></i></a> <a href="/update-item/'+data.id+'" class="btn btn-outline-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-pencil"></i></a> <a href="#" class="delete btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a>';
                }
            },
    
            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
             ],
            "drawCallback":function(setting){

            $("#item_list .view").on("click",function(e){
                $(".detail_tr").empty();
                e.preventDefault();
                var input = $('#item_list').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/item-parts-list/"+input.id,
                    method:"get",
                    success:function(data){
                        
                        $.each( data, function( key, value ) {
                          
                          $(".item_parts_tbl").append('<tr class="detail_tr">'+
                            '<td>'+value.mfr+'</td>'+
                            '<td>'+value.part_name+'</td>'+
                            '<td>'+value.description+'</td>'+
                            '<td>'+value.qty_po+'</td>'+
                            '<td>'+value.um+'</td>'+
                            '<td class="warehouse_item"></td>'+
                            '<td class="location_item"></td>'+
                            '</tr>');
                        var warehouses_array = <?php echo json_encode($warehouses); ?>;
                        jQuery.each(warehouses_array,function( i, warehouse){
                          if(value.warehouse == warehouse.id)
                          {
                            $(".warehouse_item").text(warehouse.name);
                            
                            jQuery.each(warehouse.warehouse_location,function( i, location){
                                if(value.location_rack == location.id){
                                    $(".location_item").text(location.location);
                                }
                            });
                          }
                        });
                        });
                        
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });

            $("#item_list .delete").on("click",function(e){
            e.preventDefault();
            var input = $('#item_list').DataTable().row($(this).parents('tr')).data();
            $.ajax({
                url:"/delete-item",
                method:"post",
                data:{'id':input.id,'_token':$("#token").val()},
                success:function(data){
                    
                    alert("Successfully User Deleted.");
                    $("#item_list").DataTable().draw();
                },
                error:function(data){
                    alert("There is some internal error");
                }
            });
        });
            }
        });
    });
</script>
@endsection
