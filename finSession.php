<?php
include 'header.php';
include './Models/ModDebSession.php';
include './Models/engins.php';
include './Models/types.php';
include './Models/equipements.php';
include './Models/clients.php';
include './Controllers/ctrlAjoutEngin.php';
include './Controllers/ctrlDebSession.php';
?>
<script src=list.js></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<div class="btnAjoutEngin text-center">
	<a class="btn btn-outline-primary btn-sm" href="index.php"><i class="fas fa-home fa-2x"></i> Accueil</a>
	<!-- Btn CRUD -->
	<a class="btn btn-outline-primary btn-sm" href="tableauDeBord.php"><i class="fas fa-tachometer-alt fa-2x"></i> Tableau De Bord</a>
	<a class="btn btn-outline-danger btn-sm" href="deconnexion.php"><i class="fas fa-sign-out-alt fa-2x"></i> Déconnexion</a>
</div>

<!-- Début Formulaire -->
<!-- Titre Formulaire -->
<div>
	<h1 class="text-center mt-3" id="titreAjoutEngin"> Fin de Poste</h1>
		<!-- Affichage de date et l'heure -->
		<!-- Affichage de date et l'heure -->
	<p id="dateheure"></p>
	<script>
		function pause(ms) {
			return new Promise(resolve => setTimeout(resolve, ms));
		}

		async function afficherDate() {
			while (true) {
				await pause(1000);
				var cejour = new Date();
				var options = {
					weekday: "long",
					year: "numeric",
					month: "long",
					day: "2-digit"
				};
				var date = cejour.toLocaleDateString("fr-FR", options);
				var heure = ("0" + cejour.getHours()).slice(-2) + ":" + ("0" + cejour.getMinutes()).slice(-2) + ":" + ("0" + cejour.getSeconds()).slice(-2);
				var dateheure = date + " à " + heure;
				var dateheure = dateheure.replace(/(^\w{1})|(\s+\w{1})/g, lettre => lettre.toUpperCase());
				document.getElementById('dateheure').innerHTML = dateheure;
			}
		}
		afficherDate();
	</script>



	<!-- <p class="text-center mt-3" id="petitTitre">Nous sommes le : <strong><?php setlocale(LC_TIME, "fr_FR", "French");
																				echo (strftime("%A %d %B %G </strong>et il est <strong>%H h %M</strong>")); ?></p> -->
	<p class="text-center mt-3" id="titreDebutSession">Veuillez saisir les informations</p>
</div>
<form action=" " method="POST" enctype="multipart/form-data">
	<div class="formAjoutEngin">


		<!-- Numéro d'engin -->
		<div class="form-group">
			<label for="numeroEngin" id="labelForm">Numéro d'engin</label>
			<select id="mySelect" onchange="myFunction()" class="form-control" name="numeroEngin">
				<option selected disabled>Choisissez l'engin :</option>
				<?php
				foreach ($enginListe as $numEngin) {
				?>
					<option value="<?= $numEngin->id_Engins ?>"><?= $numEngin->id_Engins . ' . ' . $numEngin->numeroEngin ?></option><?php
																																	} ?>
			</select>
			<!--message d'erreur-->
			<p class="errorForm"><?= isset($formErrors['id_Engins']) ? $formErrors['id_Engins'] : '' ?></p>
		</div>
		<!-- TYPE D'ENGINE -->
		<div class="form-group">
			<label for="id_type" id="labelForm">Type d'engin</label>
			<input oninput="this.value = this.value.toUpperCase()" class="form-control" id="typeEngin" <?= count($formErrors) > 0 ? (isset($formErrors['typeEngin']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['typeEngin']) ? $_POST['typeEngin'] : '' ?>" type="text" name="typeEngin" pattern="[0-9]" />
																																</div>

		<!-- Kilometrage -->

		<div class="form-group">
			<label for="km_reel" id="labelForm">Relevé Compteur (KM)</label>
			<input oninput="this.value = this.value.toUpperCase()" class="form-control" id="kilometrage" <?= count($formErrors) > 0 ? (isset($formErrors['numeroEngin']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['numeroEngin']) ? $_POST['numeroEngin'] : '' ?>" type="text" name="kilometrage" pattern="[0-9]" />



			<!-- EQUIPEMENTS -->

			<div class="form-group">
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" name="gridRadios" id="gridRadios1" value="option1" checked>
					<label class="form-check-label" for="gridRadios1">
						Terminal Embarqué
					</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" name="gridRadios" id="gridRadios2" value="option2" checked>
					<label class="form-check-label" for="gridRadios2">
						Imprimante
					</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="checkbox" name="gridRadios" id="gridRadios3" value="option3" checked>
					<label class="form-check-label" for="gridRadios3">
						Douchette
					</label>
					<!--message d'erreur-->
					<p class="errorForm"><?= isset($formErrors['id_equipements']) ? $formErrors['id_equipements'] : '' ?></p>
				</div>



				<!-- add attachement -->
				<div class="form-floating">
					<label for="description" id="labelForm">Declaré un incident</label>
					<input type="file" accept="image/*" id="file-input" name="images" oninput="this.value = this.value.toUpperCase()" class="form-control" id="images" <?= count($formErrors) > 0 ? (isset($formErrors['images']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['images']) ? $_POST['images'] : '' ?>" type="text" name="images">
				</div>

				<script>
					const fileInput = document.getElementById('file-input');
					fileInput.addEventListener('change', (e) => doSomethingWithFiles(e.target.files));
				</script>


				<script>
					const target = document.getElementById('target');

					target.addEventListener('drop', (e) => {
						e.stopPropagation();
						e.preventDefault();

						doSomethingWithFiles(e.dataTransfer.files);
					});

					target.addEventListener('dragover', (e) => {
						e.stopPropagation();
						e.preventDefault();

						e.dataTransfer.dropEffect = 'copy';
					});
				</script>

				<script>
					const target = document.getElementById('target');

					target.addEventListener('paste', (e) => {
						e.preventDefault();
						doSomethingWithFiles(e.clipboardData.files);
					});
				</script>
				<img id="output">
				<script>
					const output = document.getElementById('output');

					function doSomethingWithFiles(fileList) {
						let file = null;

						for (let i = 0; i < fileList.length; i++) {
							if (fileList[i].type.match(/^image\//)) {
								file = fileList[i];
								break;
							}
						}

						if (file !== null) {
							output.src = URL.createObjectURL(file);
						}
					}
					const supported = 'mediaDevices' in navigator;
				</script>



				<!-- ADD COMMENTAIRES -->


				<div class="form-group">
					<textarea onkeyup="textCounter(this,'counter',100);" id="message" placeholder="laissez vos commentaires" oninput="this.value = this.value.toUpperCase()" class="form-control" id="description" <?= count($formErrors) > 0 ? (isset($formErrors['description']) ? 'is-invalid' : 'is-valid') : '' ?>value="<?= isset($_POST['description']) ? $_POST['description'] : '' ?>" type="text" name="description"></textarea>
					<input disabled maxlength="3" size="2" value="100" id="counter" placeholder="nombre de caracères restant.">
					<small id="help" class="form-text text-muted" disabled maxlength="3" size="3" value="100" id="counter">nombre de caracères restant.</small>

					<script>
						function textCounter(field, field2, maxlimit) {
							var countfield = document.getElementById(field2);
							if (field.value.length > maxlimit) {
								field.value = field.value.substring(0, maxlimit);
								return false;
							} else {
								countfield.value = maxlimit - field.value.length;
							}
						}
					</script>

				</div>
				<!--message de succés ou d'erreur-->
				<p class="formMessage"><?= isset($addAnomaliesMessage) ? $addAnomaliesMessage : '' ?></p>
				<!-- Btn validation -->
				<button type="submit" name="addAnomalies" class="btn btn-primary">Valider</button>
				<button type="reset" class="btn btn-warning">Réinitialiser</button>
</form>

</div>
<?php
include 'footer.php'
?>