<?php
$engineKm = intval($_GET['enginKm']);

$connexion = mysqli_connect('localhost','root','','digit_engin');
if (!$connexion) {
  die('Pas de connexion: ' . mysqli_error($connexion));
}

mysqli_select_db($connexion,"debutPoste");
$sql=" SELECT `km_reel`,`nomEquipements`, `nomStatut`
FROM `engins`
JOIN equipements
JOIN statut
WHERE `equipements`.`id_equipements` = `engins`.`id_equipements`
AND `statut`.`id_statut` = `engins`.`id_statut`
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
  echo "<label for='NomEquipements' id='labelForm'>Equipements</label>";
  if ($row['nomStatut'] == 'Disponible') {
  echo "<input class='form-control text-center' type='text' name='NomEquipements' value='$row[nomEquipements]' />";
} else{
  echo "<input disabled class='form-control text-center' type='text' name='NomEquipements' value='$row[nomEquipements]' />";
}
  echo "<div class='form-group'>";
  echo "<label for='nomStatut' id='labelForm'>Disponible ?</label>";
  if ($row['nomStatut'] == 'Disponible') {
  echo  "<input disabled class='form-control text-center' style= 'background: #58C454; color:white' type='text' name='nomStatut' value='$row[nomStatut]'/>";
} else{
	echo "<input disabled class='form-control text-center'  style= 'background:#E91616; color:white ' type='text' name='nomStatut' value='$row[nomStatut]' />";

  } 
}
mysqli_close($connexion);
?>
