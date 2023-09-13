function formatCurrency(id, value){
    if(parseInt(value)){
        let number = value;
        let input_field = $('#'+id);
        let input = number.replace(/[\D\s\._\-]+/g, "");
        input = input ? parseInt(input, 10 ) : 0;
        input_field.val(input.toLocaleString( "id-ID" ));

    } else {
        $("#"+id).val(0) 
    }
}

function pad(s) { return (s < 10) ? '0' + s : s; }

function changeFormatDate(id, date) {
    let new_date = new Date(date);
    $("#"+id).val([pad(new_date.getDate()), pad(new_date.getMonth()+1), new_date.getFullYear()].join('/'))
}