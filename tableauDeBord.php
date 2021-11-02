<?php

include 'header.php';
include './Models/engins.php';
include './Models/anomalies.php';
include './Models/clients.php';
include './Models/equipements.php';
include './Controllers/ctrlTableauDeBord.php'; 
include './Controllers/ctrlListeAnomalies.php'; 
session_start();
$session['orderBy'] = isset($_POST['orderBy'])? htmlspecialchars($_POST['orderBy']) : 1;
?>

<div class="btnTdbMain text-center">
    <a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
    <!-- Btn CRUD -->
  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <div class="btn-group" role="group">
      <button id="btnGroupeAjout" type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-plus fa-2x"></i> Ajouter un Entitie</button>
        <div class="dropdown-menu p-1" aria-labelledby="btnGroupeAjout">
          <a class="btn btn-outline-success btn-sm btn-block" href="ajoutEngin.php"><i class="fas fa-dolly"></i> Un Engin</a>
          <a class="btn btn-outline-success btn-sm btn-block" href="ajoutClient.php"><i class="far fa-building"></i> Un Client</a>
          <a class="btn btn-outline-success btn-sm btn-block" href="ajoutType.php"><i class="fab fa-typo3"></i> Un Type</a>
          <a class="btn btn-outline-success btn-sm btn-block" href="ajoutEquipement.php"><i class="fas fa-wrench"></i> Un Equipement</a>
          <a class="btn btn-outline-danger btn-sm btn-block" href="AjoutAnomalies.php"><i class="fas fa-exclamation"></i> Une Anomalie</a>
        </div>
    </div>
  </div>
  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
    <div class="btn-group" role="group">
      <button id="btnGroupeModif" type="button" class="btn btn-outline-warning dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-pencil-alt fa-2x"></i> Modifier/Supprimer un Entitie</button>
        <div class="dropdown-menu p-1" aria-labelledby="btnGroupeModif">
        <a class="btn btn-outline-warning btn-sm btn-block" href="listeClients.php"><i class="fas fa-edit"></i> Un Client</a>
        <a class="btn btn-outline-warning btn-sm btn-block" href="listeTypes.php"><i class="fas fa-edit"></i> Un Type</a>
        <a class="btn btn-outline-warning btn-sm btn-block" href="listeEquipements.php"><i class="fas fa-edit"></i> Un Equipement</a>
        <a class="btn btn-outline-warning btn-sm btn-block" href="listeAnomalies.php"><i class="fas fa-edit"></i> Une Anomalie</a>
      </div>
    </div>
  </div>
    <a class="btn btn-outline-danger btn-sm" href="index.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
    </div>
  <div>
    <h1 class="text-center" id="titreTdb">Tableau de Bord - Principale</h1>
    </div>

<!-- Avertissement avent Suppression -->
<div class="container text-center">

<?php
if(isset($_GET['idDelete'])){ ?>
  <div class="alert text-center alert-dismissible">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h1 class="h4">Voulez-vous supprimer ce Engin?</h1>
      <form class="text-center" method="POST" action="tableauDeBord.php">
        <input type="hidden" name="idDelete" value="<?= $engins->id_Engins?>" />
        <button type="submit" class="btn btn-primary btn-sm" name="confirmDelete">Oui</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="alert">Non</button>
      </form>
  </div><?php
  } ?>
</div>
   <!-- TRI -->
<div class="triFiltre">
  <form class="form-inline" action = "" method="POST">
    <div class="form-group">
      <label for="tri" id="labelTri"> Trier Par</label> 
      <select name = "orderBy" id="tri" value ="trier par" class="browser-default custom-select ">
        <option value="id_Engins" <?php echo ($session['orderBy']=='id_Engins'?'selected':'')?>> Identifiant</option>
        <option value="nomTypes"<?php echo ($session['orderBy']=='nomTypes'?'selected':'')?>> Type d'Engin</option>
        <option value="numeroEngin"<?php echo ($session['orderBy']=='numeroEngin'?'selected':'')?>> Numéro</option>
        <option value="dernierRevision"<?php echo ($session['orderBy']=='dernierRevision'?'selected':'')?>> Dernier Révision</option>
        <option value="prochainRevision"<?php echo ($session['orderBy']=='prochainRevision'?'selected':'')?>> Prochain Révision</option>
        <option value="nomStatut"<?php echo ($session['orderBy']=='nomStatut'?'selected':'')?>> Disponiblité</option>
        <option value="nomEquipements"<?php echo ($session['orderBy']=='nomEquipements'?'selected':'')?>> Equipements</option>
<!--         <option value="heure_jour"<?php echo ($session['orderBy']=='heure_jour'?'selected':'')?>> Heure/J</option>
 -->        <option value="horametre"<?php echo ($session['orderBy']=='horametre'?'selected':'')?>> Horamétre</option>
        <option value="km_reel"<?php echo ($session['orderBy']=='km_reel'?'selected':'')?>> Kilométrage</option>
        <option value="nomClients"<?php echo ($session['orderBy']=='nomClients'?'selected':'')?>> Client</option>
      </select>
      
    <div class="form-group mx-sm-3 mb-2">
      <button type="submit" class="btn btn-primary btn-sm">Trier</button>
    </div>
            <!-- FILTRE -->
      <input class="form-control" id="filter" type="text" placeholder="Filtre..">


            <!-- BUTTON DE EXPORT EN CSV -->
    <div>
      <button onclick="exportCSV('xlsx')" type="button" class="btn btn-success btn-sm">Exporter en format csv</button></br>
    </div>
  </form>
</div>
</div>
<div class="pl-3 pr-3 tdbPrincipale table-responsive">
<!-- TABLEAU DE BORD -->


<table id="tototo" class="table table-hover" >
<div>
<thead >
    <tr class="tdbTr">
      <th scope="col">Identifiant</th>
      <th scope="col">Type</th>
      <th scope="col">Numéro</th>
      <th scope="col">Dernier Révision</th>
      <th scope="col">Prochain Révision</th>
      <th scope="col">Equipements</th>
      <!-- <th scope="col">Heure/J</th> -->
      <th scope="col">Horamétre</th>
      <th scope="col">Kilométrage</th>
      <th scope="col">Client</th>
     <!--  <th scope="col">Anomalies</th> -->
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody id="FiltreTable">
    <?php foreach ($listeEngins as $EnginsListe){ ?>
      <tr
       <?php if($EnginsListe->nomStatut == "Disponible") : ?> style="background-color:#A4FF7F;" <?php else : ?> style="background-color:#ff726f;" <?php endif ?>>
        <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="#exampleModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModal">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                  <div class="modal-body">
                  <p><?php $EnginsListe->nomEquipements?></p>
         
                  </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        <td><?= $EnginsListe->id_Engins ?></td>
        <td><?= $EnginsListe->nomTypes ?></td>
        <td><a data-toggle="modal" data-target="#exampleModal"><?= $EnginsListe->numeroEngin ?> </a></td>
        <td><?= $EnginsListe->dernierRevision ?></td>
        <td><?= $EnginsListe->prochainRevision ?></td>
        <td><?= $EnginsListe->nomEquipements?></td>
        <!-- <td><?= $EnginsListe->heure_jour ?></td> --> 
        <td><?= $EnginsListe->horametre?></td>
        <td><?= $EnginsListe->km_reel ?></td>
        <td><?= $EnginsListe->nomClients ?></td>
        <td><img id="imageEngin" src="<?= $EnginsListe->image?>" alt="imageEngin"/></td>
        <td> <a href="modifEngin.php?&id_Engins=<?= $EnginsListe->id_Engins ?>"><i class="fas fa-edit"></i></a>
            <a href="tableauDeBord.php?&idDelete=<?= $EnginsListe->id_Engins ?>"><i class="far fa-trash-alt"></i></a></td>
      </tr><?php }
      ?>
  </tbody>
</table>
</div>
<script>

</script>
<!-- Footer -->
<?php
  include 'footer.php'
?>