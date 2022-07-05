 $(function(){

 //typeahead

 var engine = new Bloodhound({
            remote:{

                url:'/products-data?term=%QUERY%',
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#storeItemRequest").typeahead({
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
                         return '<li id="suggestion">' + data.part_num +' - '+data.mfr +'- '+data.part_name +'- '+data.part_desc +'</li>'
                    }


                }

         });
        $('#storeItemRequest').on('typeahead:selected', function (e, datum) {
            $("#new_raw_storeItemRequest").append('<tr>'+
                // '<td><input type="text" class="form-control m-input" name="product_id[]" value="1" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.id+'" readonly="true" style="width:90px;border:none;"></td>'+
                '<td><textarea type="text" class="form-control m-input" readonly="true" style="width:120px;">'+datum.mfr+'</textarea></td>'+
                '<td><textarea type="text" class="form-control m-input"  readonly="true" style="width:120px;">'+datum.part_num+'</textarea></td>'+
                '<td><textarea type="text" class="form-control m-input"  readonly="true" style="width:120px;">'+datum.part_name+'</textarea></td>'+
                '<td><textarea type="text" class="form-control m-input"  readonly="true" style="width:200px;border:none;">'+datum.part_desc+'</textarea></td>'+
				'<td><input type="text" class="form-control m-input" value="'+datum.default_um+'" readonly="true" style="width:75px;border:none;"></td>'+
				
              
				'<td><input type="number" class="form-control m-input" name="qty_request[]" style="width:120px;"></td>'+
               
                '<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+
                '</tr>');
              
            
        });
});