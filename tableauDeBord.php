<?php
include 'header.php';
include './Models/engins.php';
include './Models/clients.php';
include './Models/equipements.php';
include './Controllers/ctrlTableauDeBord.php'; 
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
          <a class="btn btn-outline-danger btn-sm btn-block" href="anomalies.php"><i class="fas fa-exclamation"></i> Une Anomalie</a>
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
  <div class="alert alert-dismissible">
        <h1 class="h4">Voulez-vous supprimer ce Engin?</h1>
      <form class="" method="POST" action="tableauDeBord.php">
        <input type="hidden" name="idDelete" value="<?= $engins->id_engins?>" />
          <button type="submit" class="btn btn-success btn-sm" name="confirmDelete">Oui</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="alert">Non</button>
      </form>
  </div><?php
  } ?>
</div>
   <!-- TRI -->
<div class="container">
  <form class="form-inline" action="#" method="POST">
    <div class="form-group mx-sm-3 mb-2">
      <select name = "orderBy" id="tri" class="browser-default custom-select">
        <option value="" selected>Trier Par</option>
        <option value="nomTypes"> Type d'Engin</option>
        <option value="numeroEngin"> Numéro</option>
        <option value="dernierRevision"> Dernier Révision</option>
        <option value="prochainRevision"> Prochain Révision</option>
        <option value="statut"> Disponiblité</option>
        <option value="nomEquipements"> Equipements</option>
        <option value="heure_jour"> Heure/J</option>
        <option value="horametre"> Horamétre</option>
        <option value="km_reel"> Kilométrage</option>
        <option value="nomClients"> Client</option>
      </select>
    </div>
    <div class="form-group mx-sm-3 mb-2">
      <button type="submit" class="btn btn-primary btn-sm">Trier</button>
            <!-- BUTTON DE EXPORT EN CSV -->
      <button onclick="exportCSV('xlsx')" type="button" class="btn btn-success btn-sm float-left mb-1">Exporter en format csv</button></br>
    </div>
    </form>
</div>


<div class="pl-3 pr-3 tdbPrincipale table-responsive">

<!-- TABLEAU DE BORD -->
<table class="table table-hover" id="csvFormat">
<div class="filter-gallery">
<thead >
    <tr class="tdbTr">
      <th scope="col">Identifiant</th>
      <th scope="col">Type</th>
      <th scope="col">Numéro</th>
      <th scope="col">Dernier Révision</th>
      <th scope="col">Prochain Révision</th>
      <th scope="col">Equipements</th>
      <th scope="col">Heure/J</th>
      <th scope="col">Horamétre</th>
      <th scope="col">Km Réel</th>
      <th scope="col">Client</th>
      <th scope="col">Anomalies</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($listeEngins as $EnginsListe){ ?>
      <tr <?php if($EnginsListe->statut == "Oui"): ?> style="background-color:#A4FF7F;" <?php else : ?> style="background-color:#ff726f;" <?php endif ?>>
        <td><?= $EnginsListe->id_Engins ?></td>
        <td><?= $EnginsListe->nomTypes ?></td>
        <td><?= $EnginsListe->numeroEngin ?></td>
        <td><?= $EnginsListe->dernierRevision ?></td>
        <td><?= $EnginsListe->prochainRevision ?></td>
        <td><?= $EnginsListe->nomEquipements?></td>
        <td><?= $EnginsListe->heure_jour ?></td>
        <td><?= $EnginsListe->horametre?></td>
        <td><?= $EnginsListe->km_reel ?></td>
        <td><?= $EnginsListe->nomClients ?></td>
        <td>
        <a><i class="far fa-comment-alt fa-2x" data-toggle="modal" data-target="#modalAnomalies"></i></a>
          <div class="modal fade" id="modalAnomalies" tabindex="-1" aria-labelledby="modalAnomalies" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalAnomalies">Description des Anomalies</h5>
                </div>
                  <div class="modal-body"><?= $EnginsListe->description?>
                    <div><img id="imgAnomalies" src="<?= $EnginsListe->ImageAnom1?>" alt="ImgAnomalies1"/> <img id="imgAnomalies" src="<?= $EnginsListe->ImageAnom2?>" alt="ImgAnomalies2"/> <img id="imgAnomalies" src="<?= $EnginsListe->ImageAnom2?>" alt="ImgAnomalies3"/></div>
                  </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Ok</button>
                </div>
              </div>
            </div>
          </div></td> <!-- Description des anomalies -->

        <td> <a href="modifEngin.php?&id=<?= $EnginsListe->id_Engins ?>"><i class="fas fa-edit"></i></a>
            <a href="tableauDeBord.php?&idDelete=<?= $EnginsListe->id_Engins ?>"><i class="far fa-trash-alt"></i></a></td>
      </tr><?php }
      
    ?>
    
  </tbody>
    </table>
</div>
<!-- Footer -->
<?php
  include 'footer.php'
?>