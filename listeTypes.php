<?php
include 'header.php';
include './Models/types.php';
include './Controllers/ctrlListeTypes.php'; 
?>
<div class="btnListeEquipements text-center">
<a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
</div> 

<div>
  <h1 class="text-center mt-3" id="titreTdb">Modifier ou Supprimer un Type</h1>
</div>

<!-- Avertissement avent Suppression -->
<?php
if(isset($_GET['idDelete'])){ ?>
  <div class="alert text-center alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h1 class="h4">Voulez-vous supprimer ce Type?</h1>
      <form class="text-center" method="POST" action="listeTypes.php">
        <input type="hidden" name="idDelete" value="<?= $types->id_types?>" />
        <button type="submit" class="btn btn-primary btn-sm" name="confirmDelete">Oui</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="alert">Non</button>
      </form>
  </div><?php
  } ?>

<div class="pl-3 pr-3 tableTypes table-responsive">
<table class="table table-hover" id="listeTypes">
<button onclick="exportCSVTypes('xlsx')" class="btn btn-success btn-sm float-left mb-1">Exporter en format csv</button>
  <thead >
    <tr class="tdbTr">
      <th scope="col">Identifiant</th>
      <th scope="col">Nom de Type</th>
      <th scope="col">Modifier ou Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listeTypes as $typesListe){ ?>
      <tr>
        <td><?= $typesListe->id_types ?></td>
        <td><?= $typesListe->nomTypes ?></td>
        <td> <a href="modifType.php?&id_types=<?= $typesListe->id_types ?>"><i class="fas fa-edit fa-2x"></i></a>
            <a href="listeTypes.php?&idDelete=<?= $typesListe->id_types ?>"><i class="far fa-trash-alt fa-2x"></i></a></td>
      </tr><?php }
    ?>
  </tbody>
    </table>
    
</div>

<!-- Footer -->
<?php
  include 'footer.php'
?>