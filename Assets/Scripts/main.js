function exportCSV(type, fn, dl) {
    var elt = document.getElementById('csvFormat');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet JS" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Liste.' + (type || 'xlsx')));
}

$(document).ready(function() {
    $('#csvFormat').DataTable();
    $('.dataTables_length').addClass('bs-select');
});


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