<?php
include 'header.php';
include './Models/equipements.php';
include './Controllers/ctrlListeEquipements.php'; 
?>
<div class="btnListeEquipements text-center">
  <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
  <a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
</div> 

<div>
  <h1 class="text-center mt-3" id="titreTdb">Modifier ou Supprimer un Equipement</h1>
</div>

<!-- Avertissement avent Suppression -->
<?php
if(isset($_GET['idDelete'])){ ?>
  <div class="alert text-center alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h1 class="h4">Voulez-vous supprimer ce Equipement?</h1>
      <form class="text-center" method="POST" action="listeEquipements.php">
        <input type="hidden" name="idDelete" value="<?= $equipements->id_equipements?>" />
        <button type="submit" class="btn btn-primary btn-sm" name="confirmDelete">Oui</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="alert">Non</button>
      </form>
  </div><?php
  } ?>

<div class="pl-3 pr-3 tableEquipements table-responsive">
<table class="table table-hover" id="listeEquipements">
<button onclick="exportCSVEquipements('xlsx')" type="button" class="btn btn-success btn-sm float-left mb-1">Exporter en format csv</button>
  <thead >
    <tr class="tdbTr">
      <th scope="col">Identifiant</th>
      <th scope="col">Nom de Equipement</th>
      <th scope="col">Modifier ou Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listeEquipements as $equipementsListe){ ?>
      <tr>
        <td><?= $equipementsListe->id_equipements ?></td>
        <td><?= $equipementsListe->nomEquipements ?></td>
        <td> <a href="modifEquipements.php?&id_equipements=<?= $equipementsListe->id_equipements ?>"><i class="fas fa-edit fa-2x"></i></a>
            <a href="listeEquipements.php?&idDelete=<?= $equipementsListe->id_equipements ?>"><i class="far fa-trash-alt fa-2x"></i></a></td>
      </tr><?php }
    ?>
  </tbody>
    </table>
</div>
<!-- Footer -->
<?php
  include 'footer.php'
?>