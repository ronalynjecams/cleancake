function checkPrice(){
    var prod_value = [];
    $('.prod_value').each(function (index) {
        prod_value.push($(this).val());
    });
    
    if (prod_value.indexOf("") < 0){
        var property = [];
        var variants = JSON.parse($('#variants').val());
        var base_price = 0;
        var id = 0;
        var result = [];
        var result_arr = [];
        
        $('.prod_prop').each(function (index) {
            property.push($(this).val());
        });
        
        $.each(prod_value, function( index, value ) {
            result = result.concat($.grep(variants, function(e, key){
                    return e.attribute_name == property[index] && e.attribute_value == value; 
                }));
        });
        
        if(Object.keys(result).length == 1){
            base_price = result[0].base_price;
            id = result[0].id;
        }else{
            $.each(result, function( index, value ) {
                result_arr.push(value.id);
            });
            var duplicate = result_arr.reduce(function(acc, el, i, arr) {
              if (arr.indexOf(el) !== i && acc.indexOf(el) < 0) acc.push(el); return acc;
            }, []);
            console.log(duplicate);
            console.log("end dupes");
            $.each(result, function( index, value ) {
                console.log(value.id+ ' '+value.base_price)
                if(value.id == duplicate){
                    base_price = value.base_price;
                    id = duplicate;
                }
            });
        }
        
        return {base_price: base_price, id: id};
    }
    return {base_price: 0, id: 0};
};
