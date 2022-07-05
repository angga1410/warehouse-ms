var DatatablesDataSourceAjaxClient= {
    init:function() {
        $("#qc_request").DataTable( {
            responsive:!0, ajax: {
                url:"/qc-request-list-dt", type:"GET", data: {
                    pagination: {
                        perpage: 20
                    }
                }
            }
            , columns:[ 
            {
                data: "id"
            },
            {
                data: "entry_queue_id"
            },
            {
                data: "document_no"
            },
            {
                 data: function(data){
                    return data.user.name
                }
            },
            {
                data: "remark"
            },
            {
                data: "created_at"
            },
            {
                
                data: function(data){
                    return '<a style="text-decoration: none;" href="#" data-toggle="modal" data-target="#m_modal_2" class="view btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--outline-2x m-btn--pill m-btn--air btn-sm"><i class="la la-eye"></i></a>';
                }
            },
    
            // ]   , columnDefs:[{
            //     targets:2, render:function(data) {
            //         return null;
            //     }
            // }
             ],
            "drawCallback":function(setting){

                $("#qc_request .view").on("click",function(e){
                $(".detail_tr").empty();
                e.preventDefault();
                var input = $('#qc_request').DataTable().row($(this).parents('tr')).data();
                $.ajax({
                    url:"/qc-request-parts-list/"+input.id,
                    method:"get",
                    success:function(data){
                        // alert("Successfully");
                        
                        $.each( data, function( key, value ) {
                          
                          $(".qcitem_parts_tbl").append('<tr class="detail_tr"><td>'+value.mfr+'</td> <td>'+value.part_name+'</td> <td>'+value.part_desc+'</td> <td>'+value.qty_qc+'</td> <td>'+value.default_um+'</td></tr>');
                         
                        });
                        
                    },
                    error:function(data){
                        alert("There is some internal error");
                    }
                });
            });
            }
        }
        )
    }
};

if($('#qcRequest').length !== 0) {
    DatatablesDataSourceAjaxClient.init()
}

$(function(){
    $(".btn_add_qc").on("click",function(){
        $(".new_qc_raw").append('<tr><td><input type="text" name="mfr[]" class="mfr" style="width: 100px;"></td><td><input type="text" name="part_name[]" class="part_name"></td> <td><input type="text" name="description[]" class="description"></td><td><input type="text" name="qty_qc[]" class="qty_qc" style="width: 100px;"></td><td><input type="text" name="um[]" class="um" style="width: 100px;"></td></tr>');
    });
});