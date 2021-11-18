<?php
require ('inc/fonction.php');
require ('inc/request.php');
// variable errors
$errors=[];
// sql recup tous les vaccins pour la liste déroulante
$vaccins = getAllVaccinName();
debug($vaccins);
echo '<br>';


include ('inc/header.php');?>
<section id="home_register">
		<div class="wrap0">
			<div class="title_absolute uppercase">
				<h3 class="text-shadow">Ajoutez un nouveau <span class="uppercase">vaccin</span></h3>
				<h3 class="text-shadow">   à votre carnet de santé</h3>
			</div>
		</div>
	</section>
	<form class="wrap3" action="" method="post" novalidate>
		<div class="wrap4">

			<div class="input_group">
				<label for="age">date de vaccination</label>
				<input type="date" name="age" id="age" value="">
				<?php viewError($errors,'age')  ?>
			</div>

			<div class="input_group">
				<label for="vaccin">Selectionez un vaccins</label>
				<select name="vaccin" id="vaccin">
					<option value="">__sélectionnez__</option>
						<?php foreach ($vaccins as $key => $vaccin) { ?>
								<?php if(!empty($_POST['vaccin']) && $_POST['vaccin'] == $key ) { ?>
								<option value="<?php echo $key; ?>" selected><?php echo $vaccin; ?></option>
								<?php } else { ?>
								<option value="<?php echo $key; ?>"><?php echo $vaccin; ?></option>
								<?php } ?>
						<?php } ?>
				</select>
				<span class="error"><?php if(!empty($errors['vaccin'])) {echo $errors['vaccin']; } ?></span>
			</div>

			<input type="submit" name="submitted" value="Envoyer">

		</div>
	</form>

<?php
include ('inc/footer.php');