<?php
include 'header.php';
include './Models/clients.php';
include './Controllers/ctrlListeClients.php'; 
?>
<div class="btnListeClients text-center">
  <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
  <a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
  <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a><!-- Btn de deconnexion -->
</div> 

<div>
  <h1 class="text-center mt-3" id="titreTdb">Modifier ou Supprimer un Client</h1>
</div>



<!-- Avertissement avent Suppression -->
<?php
if(isset($_GET['idDelete'])){ ?>
  <div class="alert text-center alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h1 class="h4">Voulez-vous supprimer ce Client?</h1>
      <form class="text-center" method="POST" action="listeClients.php">
        <input type="hidden" name="idDelete" value="<?= $clients->id_Clients?>" />
        <button type="submit" class="btn btn-primary btn-sm" name="confirmDelete">Oui</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="alert">Non</button>
      </form>
  </div><?php
  } ?>

<div class="pl-3 pr-3 tableClients table-responsive">
<table class="table table-hover" id="listeClients">
<button onclick="exportCSV('xlsx')" type="button" class="btn btn-success btn-sm float-left mb-1">Exporter en format csv</button>
  <thead >
    <tr class="tdbTr">
      <th scope="col">Identifiant</th>
      <th scope="col">Nom de Client</th>
      <th scope="col">Modifier ou Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listeClients as $clientsListe){ ?>
      <tr>
        <td><?= $clientsListe->id_Clients ?></td>
        <td><?= $clientsListe->nomClients ?></td>
        <td> <a href="modifClient.php?&id_Clients=<?= $clientsListe->id_Clients ?>"><i class="fas fa-edit fa-2x"></i></a>
            <a href="listeClients.php?&idDelete=<?= $clientsListe->id_Clients ?>"><i class="far fa-trash-alt fa-2x"></i></a></td>
      </tr><?php }
    ?>
  </tbody>
    </table>
</div>
<!-- Footer -->
<?php
  include 'footer.php'
?>