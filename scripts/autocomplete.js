function showHint(str, table, attribut) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../scripts/autocomplete.php?table="+table+"&attribut="+attribut+"&q=" + str, true);
        xmlhttp.send();
    }
}
