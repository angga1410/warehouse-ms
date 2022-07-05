 $(function(){
 //    var result = null;
 // var options = {
 //        ajax          : {
 //            url     : '/items-data',
 //            type    : 'get',
 //            dataType: 'json',
 //            // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
 //            // automatically replace it with the value of the search query.
 //            data    : {
 //                q: '{{{q}}}'
 //            }
 //        },
 //        locale        : {
 //            emptyTitle: 'Select Item'
 //        },
 //        log           : 3,
 //        preprocessData: function (data) {
 //            console.log(data);
 //            result = data;
 //            var i, l = data.length, array = [];
 //            if (l) {
 //                for (i = 0; i < l; i++) {
 //                    array.push($.extend(true, data[i], {
 //                        text : data[i].mfr,
 //                        value: data[i].mfr,
 //                        data : {
 //                            subtext: data[i].mfr
 //                        }
 //                    }));
 //                }
 //            }
 //            // You must always return a valid array when processing data. The
 //            // data argument passed is a clone and cannot be modified directly.
 //            return array;
 //        }
 //    };
 //    $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);
 //    $('select').trigger('change');

 //    $('.selectpicker').on("change",function(){
 //        var currentVal = $(this).val();
 //        var j = $(".j").val();
        
 //        console.log(j);
 //        $.each(result, function (id, optiondata) {
 //            if(currentVal == optiondata.mfr)
 //            {
 //                $(".mfr"+j).val(optiondata.mfr);
 //                $(".item_id"+j).val(optiondata.item_id);
 //                $(".part_name_material"+j).val(optiondata.part_name);
 //                $(".description_material"+j).val(optiondata.description);
 //                $(".qty_request_material"+j).val(optiondata.qty_po);
 //                $(".um_material"+j).val(optiondata.um);
 //                j++;
 //            }
 //        })

 //         $(".j").val(j);  
 //    });
 //    $(".selectpicker").selectpicker("refresh");

 //typeahead

 var engine = new Bloodhound({
            remote:{

                url:'/items-data?term=%QUERY%',
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchRecord").typeahead({
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
                                     return '<li id="suggestion">' + data.product_number + '</li>'
                                }

                }

         });
        $('#searchRecord').on('typeahead:selected', function (e, datum) {
            $("#material_request_btn").show();
            $("#new_raw").append('<tr>'+
                '<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.id+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="mfr[]" value="'+datum.mfr+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="product_number[]" value="'+datum.product_number+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="part_name[]" value="'+datum.part_name+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="description[]" value="'+datum.description+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><input type="text" class="form-control m-input" name="qty_request[]" required style="width:75px;"></td>'+
                '<td><input type="text" class="form-control m-input" name="um[]" value="'+datum.um+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td><a class="deleteItem btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn-sm"><i class="la la-close"></i></a></td>'+
                '<input type="hidden" value="'+4+'" name="warehouse[]">'+
                '<input type="hidden" value="'+1+'" name="location_rack[]">'+
                '</tr>');
            
        });
});