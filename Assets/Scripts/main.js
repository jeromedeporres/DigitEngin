/* CSV FORMAT TYPES*/
function exportCSV(type, fn, dl) {
    var elt = document.getElementById('listeTypes');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet JS" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Liste_Types_Engins.' + (type || 'xlsx')));
}

$(document).ready(function() {
    $('#listeTypes').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

/* CSV FORMAT EQUIPEMENTS*/
function exportCSV(type, fn, dl) {
    var elt = document.getElementById('listeEquipements');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet JS" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Liste_equipements_sur_engin.' + (type || 'xlsx')));
}

$(document).ready(function() {
    $('#listeEquipements').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

/* CSV FORMAT CLIENTS*/
function exportCSV(type, fn, dl) {
    var elt = document.getElementById('listeClients');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet JS" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Liste_clients.' + (type || 'xlsx')));
}

$(document).ready(function() {
    $('#listeClients').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

/* CSV FORMAT ANOMALIES*/
function exportCSV(type, fn, dl) {
    var elt = document.getElementById('listeAnomalies');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet JS" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Liste_Anomalies.' + (type || 'xlsx')));
}

$(document).ready(function() {
    $('#listeAnomalies').DataTable();
    $('.dataTables_length').addClass('bs-select');
});

/* ZOOM IMAGES */
function zoomIn() {
    /*     console.log('test'); */
    imgAnomalies.height *= 2;
    imgAnomalies.width *= 2;
    /*     console.log('test2'); */
}

function zoomOut() {
    imgAnomalies.height = imgAnomalies.height / 2;
    imgAnomalies.width = imgAnomalies.width / 2;
}

/* LIMITATION DES CHARECTEURS SUR OBSERVATION */
function textCounter(field, field2, maxlimit) {
    var countfield = document.getElementById(field2);
    if (field.value.length > maxlimit) {
        field.value = field.value.substring(0, maxlimit);
        return false;
    } else {
        countfield.value = maxlimit - field.value.length + " Caractères restent";
    }
}

/* FILTRE TABLE */
$(document).ready(function() {
    $("#filter").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#FiltreTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


/* PAGINATION */
/* $(function() {
    $("#tototo").simplePagination({
        previousButtonClass: "btn btn-danger",
        nextButtonClass: "btn btn-danger"
    });


}); */

/* TIMER */
/* function display_c() {
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_ct()', refresh)
}

function display_ct() {
    var x = new Date()
    document.getElementById('ct').innerHTML = x;
    display_c();
}
 */




$(document).ready(function() {
    var multiChoix = new Choices('#equipements', {
        removeItemButton: true

    });
});

/* DATE ET L'HEURE */

document.getElementById('dateHeure').value = new Date().toDateInputValue();

/* KM BY ENGIN */
function selectEngin(str) {
    if (str == "") {
        document.getElementById("prisePosteInfo").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("prisePosteInfo").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "./Models/debPoste.php?enginKm=" + str, true);
        xmlhttp.send();
    }
}