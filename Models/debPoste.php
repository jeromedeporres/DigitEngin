<?php
$engineKm = !empty($_GET['enginKm']) ? htmlspecialchars($_GET['enginKm']) : "";

$connexion = mysqli_connect('localhost','root','','digit_engin');
if (!$connexion) {
  die('Pas de connexion: ' . mysqli_error($connexion));
}

mysqli_select_db($connexion,"debutPoste");
$sql=" SELECT `km_reel`,`nomEquipements`, `nomStatut`, `observation`,`imageObservation`
FROM `engins`
/* JOIN equipements */
JOIN statut
/* WHERE `equipements`.`id_equipements` = `engins`.`id_equipements` */
WHERE `statut`.`id_statut` = `engins`.`id_statut`
AND `id_Engins`= '".$engineKm."'";
$resultat = mysqli_query($connexion,$sql);

while($row = mysqli_fetch_array($resultat)) {

  echo "<div class='form-group'>";
  echo "<label for='km_reel' id='labelForm'>Relevé de compteur</label>";
  if ($row['nomStatut'] == 'Disponible') {
  echo "<input class='form-control text-center' type='number' name='km_reel' value='$row[km_reel]' />";
} else{
  echo "<input disabled class='form-control text-center' type='number' name='km_reel' value='$row[km_reel]' />";
}
  echo "<div class='form-group'>";
  echo "<label for='nomEquipements' id='labelForm'>Equipements</label>";
  if ($row['nomStatut'] == 'Disponible') {
  echo "<input oninput='this.value = this.value.toUpperCase()' class='form-control text-center' type='text' name='nomEquipements' value='$row[nomEquipements]' />";
} else{
  echo "<input disabled class='form-control text-center' type='text' name='nomEquipements' value='$row[nomEquipements]' />";
}
  echo "<div class='form-group'>";
  echo "<label for='nomStatut' id='labelForm'>Disponible ?</label>";
  if ($row['nomStatut'] == 'Disponible') {
  echo  "<input disabled class='form-control text-center' style= 'background: #58C454; color:white' type='text' name='nomStatut' value='$row[nomStatut]'/>";
} else{
	echo "<input disabled class='form-control text-center'  style= 'background:#E91616; color:white ' type='text' name='nomStatut' value='$row[nomStatut]' />";

  } 
  echo "<div class='form-group'>";
  echo "<label for='observation' id='labelForm'>Observation</label>";
  if ($row['nomStatut'] == 'Disponible') {
  echo "<textarea class='form-control text-center' maxlength='300' name='observation'>$row[observation]</textarea>";
  echo "<p>Veuillez séparer par une virgule / Ex : Observation1, Observation2 etc...</p>"; 
} else{
  echo "<input disabled class='form-control text-center' name='observation' value ='$row[observation]'/>";
}

echo "<div class='form-group'>";
if ($row['imageObservation'] == true) {
  echo "<p id='labelForm'>Image d'anomalie existant</p>";
  echo "<img src='$row[imageObservation]' alt='imageObservation' width='100' height='100'>";
}


echo "<div class='form-group'>";
echo "<label for='imageObservation' id='labelForm'>Ajouter une image d'Anomalie</label>";
echo "<input id='imageObservation' class='form-control value='$row[imageObservation]' type='file' name='imageObservation'/>";

}
mysqli_close($connexion);

?>
