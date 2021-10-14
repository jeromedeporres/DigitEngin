<?php
include 'header.php';
include './Models/anomalies.php';

include './Controllers/ctrlListeAnomalies.php'; 
?>
<div class="btnListeClients text-center">
  <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
  <a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
  <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a><!-- Btn de deconnexion -->
</div> 

<div>
  <h1 class="text-center mt-3" id="titreTdb">Modifier ou Supprimer une Anomalie</h1>
</div>

<!-- Avertissement avent Suppression -->
<?php
if(isset($_GET['idDelete'])){ ?>
  <div class="alert text-center alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h1 class="h4">Voulez-vous supprimer cette Anomalie?</h1>
      <form class="text-center" method="POST" action="listeAnomalies.php">
        <input type="hidden" name="idDelete" value="<?= $anomalies->id_anomalies?>" />
        <button type="submit" class="btn btn-primary btn-sm" name="confirmDelete">Oui</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="alert">Non</button>
      </form>
  </div><?php
  } ?>

<div class="pl-3 pr-3 tableAnomalies table-responsive">
<table class="table table-hover" id="csvFormat">
<button onclick="exportCSV('xlsx')" type="button" class="btn btn-success btn-sm float-left mb-1">Exporter en format csv</button>
  <thead >
    <tr class="tdbTr">
      <th scope="col">Identifiant</th>
      <th scope="col">Observation</th>
	  <th scope="col">Image 1</th>
	  <th scope="col">Image 2</th>
	  <th scope="col">Image 3</th>
      <th scope="col">Modifier ou Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listeAnomalies as $anomalies){ ?>
      <tr>
        <td><?= $anomalies->id_anomalies ?></td>
        <td><?= $anomalies->description ?></td>
		<td><img id="imgAnomalies" src="<?= $anomalies->imageAnom1?>" alt="ImgAnomalies1" height="30" width="30"></img></td>
		<td><img id="imgAnomalies" src="<?= $anomalies->imageAnom2?>" alt="ImgAnomalies2" height="30" width="30"></img></td>
		<td><img id="imgAnomalies" src="<?= $anomalies->imageAnom3?>" alt="ImgAnomalies3" height="30" width="30"></img></td>
        <td> <a href="modifAnomalies.php?&id_anomalies=<?= $anomalies->id_anomalies ?>"><i class="fas fa-edit fa-2x"></i></a>
            <a href="listeAnomalies.php?&idDelete=<?= $anomalies->id_anomalies ?>"><i class="far fa-trash-alt fa-2x"></i></a></td>
      </tr><?php }
    ?>
  </tbody>
    </table>
</div>
<!-- Footer -->
<?php
  include 'footer.php'
?>