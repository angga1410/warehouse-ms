$(function(){

var engine = new Bloodhound({
            remote:{

                url:'/transferitems-data?term=%QUERY%',
                wildcard:'%QUERY%' 
            },

                datumTokenizer: Bloodhound.tokenizers.whitespace('term'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        engine.initialize();

        $("#searchItems").typeahead({
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
        $('#searchItems').on('typeahead:selected', function (e, datum) {
            console.log(datum);
            $("#btn_transfer").show();
            $("#new_raw_transfer").append('<tr class="dataRow">'+
                '<td><input type="text" class="form-control m-input" name="product_id[]" value="'+datum.id+'" readonly="true" style="width:75px;border:none;"></td>'+
                '<td>'+datum.mfr+'</td>'+
                '<td>'+datum.product_number+'</td>'+
                '<td>'+datum.part_name+'</td>'+
                '<td>'+datum.description+'</td>'+
                '<td><input type="text" class="form-control m-input" name="qty[]" value="'+datum.qty+'" style="width:75px;"></td>'+
                '<td>'+datum.um+'</td>'+
                '</tr>');
        });
});