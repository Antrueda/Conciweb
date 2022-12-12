
var getOption=function(dataxxxx){
    $("#" + dataxxxx.comboidx).append(
        "<option " +
        dataxxxx.selected +
            ' value="' +
            dataxxxx.valuexxx +
            '">' +
            dataxxxx.optionxx +
            "</option>"
    );
}

var getCombo = function(dataxxxx, json) {
    $("#" + json.comboxxx).empty();
    $.each(json.dataxxxx, function(i, d) {
        var selected = "";
        if (dataxxxx.psalecte == d.valuexxx) {
            selected = "selected";
        }
        getOption({comboidx:json.comboxxx,selected:selected,valuexxx:d.valuexxx,optionxx:d.optionxx});
    });
};
