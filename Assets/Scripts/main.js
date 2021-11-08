/* CSV FORMAT TYPES*/
function exportCSVTypes(type, fn, dl) {
    var elt = document.getElementById('listeTypes');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet1" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Liste_Types_Engins.' + (type || 'xlsx')));
}

/* CSV FORMAT EQUIPEMENTS*/
function exportCSVEquipements(type, fn, dl) {
    var elt = document.getElementById('listeEquipements');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet JS" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Liste_equipements_sur_engin.' + (type || 'xlsx')));
}

/* CSV FORMAT CLIENTS*/
function exportCSVClients(type, fn, dl) {
    var elt = document.getElementById('listeClients');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet JS" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Liste_clients.' + (type || 'xlsx')));
}

/* CSV FORMAT ANOMALIES*/
function exportCSVAnomalies(type, fn, dl) {
    var elt = document.getElementById('listeAnomalies');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "Sheet JS" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('Liste_Anomalies.' + (type || 'xlsx')));
}


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


/* DATE ET L'HEURE */

/* document.getElementById('dateHeure').value = new Date().toDateInputValue();
 */
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

/*compte*/
function checkUnavailability(input) {
    //Instanciation de l'objet XMLHttpRequest permettant de faire de l'AJAX
    var request = new XMLHttpRequest();
    //Les données sont envoyés en POST et c'est le controlleur qui va les traiter
    request.open('POST', 'Controllers/ctrlInscription.php', true);
    //Au changement d'état de la demande d'AJAX
    request.onreadystatechange = function() {
            //Si on a bien fini de recevoir la réponse de PHP (4) et que le code retour HTTP est ok (200)
            if (request.readyState == 4 && request.status == 200) {
                if (request.responseText == 1) { //Dans le cas ou la valeur dans le champ est déjà en BDD
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                } else if (request.responseText == 2) { //Dans le cas où le champ est vide
                    input.classList.remove('is-valid', 'is-invalid');
                } else { //Dans le cas ou la valeur dans le champ n'est pas en BDD
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                }
            };
        }
        // Pour dire au serveur qu'il y a des données en POST à lire dans le corps
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    //Les données envoyées en POST. Elles sont séparées par un &
    request.send('fieldValue=' + input.value + '&fieldName=' + input.name);
}