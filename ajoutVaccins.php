<?php
session_start();
require ('inc/fonction.php');
require ('inc/request.php');
debug($_SESSION);
$errors = [];

if (!empty($_POST['submitted'])) {

    // Faille XSS

    // Validation des champs



    // Si la personne n'a pas renseigné de vaccin dans le select (select => vide)
        // Erreur !

    // Récupérer id_vaccin => $id_vaccin
    // Récupérer id_user => $id_user
    // Si aucune erreur
        // Insérer les données dans psv_carnet
            // => ID AI
            // => id_vaccin - $id_vaccin
            // => id_user - $id_user
            // => premiere_date - $date
}


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
                <?php
                $vaccins = array(
                    'covid' => 'C0VID 19',
                    'act-hib' => 'ACT-HIB',
                    'hépatie' => 'AVAXIM 160 U',
                );
                ?>
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