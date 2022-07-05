 $(function(){
 var engine = new Bloodhound({
            remote:{

                url:'/products-data?term=%QUERY%',
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchProduct").typeahead({
            hint: true,
            highlight: true,
            minLength:1
            }, 
            {
                source: engine.ttAdapter(),
                 displayKey: 'product_number',
                 limit:50,
                templates: {
                    empty: [
                        '<div class="empty-message">unable to find any</div>'
                    ],
                                suggestion: function (data) 
                                {
                                     return '<li id="suggestion">' + data.part_num +' - '+data.part_name +'</li>'
                                }

                }

         });
        $('#searchProduct').on('typeahead:selected', function (e, datum) {
            $("#btn_qc").show();
            $("#new_raw_qc").append('<tr>'+
                // '<td><input type="text" class="form-control m-input" name="product_id[]" value="1" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.id+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.part_num+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.part_desc+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="qty_qc[]" required style="width:75px;"></td>'+
                '<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.default_um+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+
                '</tr>');
            
        });
 
});