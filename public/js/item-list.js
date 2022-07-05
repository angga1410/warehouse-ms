var DatatablesDataSourceAjaxClient= {
    init:function() {
        $("#item_list").DataTable( {
            responsive:!0, ajax: {
                url:"/item-list-dt", type:"GET", data: {
                    pagination: {
                        perpage: 50
                    }
                }
            }
            , columns:[ 
            {
                data: "id"
            },
            {
                data: "item_name"
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
                    return '<a href="#" style="text-decoration: none;" data-toggle="modal" data-target="#m_modal_1" class="view btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-eye"></i></a>';
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
                        // alert("Successfully");
                        
                        $.each( data, function( key, value ) {
                          
                          $(".item_parts_tbl").append('<tr class="detail_tr"><td>'+value.mfr+'</td> <td>'+value.part_name+'</td> <td>'+value.description+'</td> <td>'+value.qty_po+'</td> <td>'+value.qty_sent+'</td> <td>'+value.balance+'</td> <td>'+value.qty_receive+'</td> <td>'+value.um+'</td></tr>');
                         
                        });
                        
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            }
        })
    }
};

if($('#itemList').length !== 0) {
    DatatablesDataSourceAjaxClient.init()
}

$(function(){
    $(".btn_add").on("click",function(){
        $(".new_raw").append('<tr><td><input type="text" name="mfr[]" class="mfr" style="width: 100px;"></td><td><input type="text" name="part_name[]" class="part_name"></td> <td><input type="text" name="description[]" class="description"></td><td><input type="text" name="qty_po[]" class="qty_po" style="width: 100px;"></td><td><input type="text" name="qty_sent[]" class="qty_sent" style="width: 100px;"></td><td><input type="text" name="balance[]" class="balance" style="width: 100px;"></td><td><input type="text" name="qty_receive[]" class="qty_receive" style="width: 100px;"></td><td><input type="text" name="um[]" class="um" style="width: 100px;"></td></tr>');
    });
});