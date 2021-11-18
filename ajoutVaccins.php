<?php
session_start();
require ('inc/fonction.php');
require ('inc/request.php');

$errors=[];
// sql recup tous les vaccins pour la liste déroulante
$vaccins = getAllVaccinName();
debug($vaccins);
echo '<br>';


include ('inc/header.php');?>

<div class="wrap3">
    <form action="" method="post" novalidate>
        <div class="wrap4">
            <div class="input_group">
                <label for="date">Date d'injection</label>
                <input type="date" name="date" id="date" value="">
                <?php viewError($errors,'date')  ?>
            </div>
            <div class="input_group">
                <label for="status">Choisir le vaccin</label>
                <select name="status" id="status">
                    <option value="">Sélectionnez un vaccin</option>
                    <?php foreach ($vaccins as $key => $vaccin) { ?>
                        <?php if(!empty($_POST['status']) && $_POST['status'] == $key ) { ?>
                            <option value="<?php echo $key; ?>"><?php echo $vaccin; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $key; ?>"><?php echo $vaccin; ?></option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>

            <input type="submit" name="submitted" id="submitted" value="Enregistrer">
        </div>
    </form>
</div>


<?php
include ('inc/footer.php');