<?php
session_start();
require ('../inc/pdo.php');
require ('../inc/fonction.php');
require ('../inc/request.php');
error403();
$errors = array(); // soit array(); soit ca [] pour qua c'est un tableau

if (!empty($_GET['id'])){
    $id = $_GET['id'];

    $vaccin = getIdVaccin($id);

    if (!empty($_POST['submitted'])) {
        //faille xss
        $libelle = cleanXss('libelle');
        $temps_rappel = cleanXss('temps_rappel');
        $country = cleanXss('country');
        $obligatoire = cleanXss('obligatoire');
        $description = cleanXss('description');
        $laboratoire = cleanXss('laboratoire');

        //validation
        $errors = textValidation($errors,$libelle,'libelle', 2,255);
        $errors = textValidation($errors,$temps_rappel,'temps_rappel', 1,3);
        $errors = textValidation($errors,$country,'country', 1,255);
        $errors = textValidation($errors,$description,'description', 5,500);
        $errors = textValidation($errors,$laboratoire,'laboratoire', 2,150);


        if (count($errors) == 0 ) {
            //requete sql

            updateVaccin($id,$libelle,$temps_rappel,$country,$obligatoire,$description,$laboratoire);
        }
    }
} else {
    header('Location: list_vaccin.php?error=ID');
}




include('inc/header_back.php');
?>

    <div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Modifier un vaccin <i class="fas fa-syringe"></i></h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Accueil</a></li>
                    <li class="breadcrumb-item active">Modifier un vaccin</li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Tab panes -->
                    <div class="card-body">
                        <form class="form-horizontal form-material" method="post" novalidate>
                            <div class="form-group">
                                <label for="libelle" class="col-md-12">libéllé</label>
                                <div class="col-md-12">
                                    <input type="text" name="libelle" id="libelle" placeholder="<?=$vaccin['libelle'] ?>" value="<?= recupInputValue('libelle') ?>" class="form-control form-control-line">
                                    <?= viewError($errors,'libelle') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="temps_rappel" class="col-md-12">Temps rappel</label>
                                <div class="col-md-12">
                                    <input type="number" name="temps_rappel" id="temps_rappel" placeholder=" <?php if (!empty($vaccin)){ echo $vaccin['temps_rappel'];} else { echo 'Nombre de mois'; } ?>" min="3" max="100" value="<?= recupInputValue('temps_rappel') ?>" class="form-control form-control-line">
                                    <?= viewError($errors,'temps_rappel') ?>
                                </div>
                            </div>

                            <?php

                            $countrys = [
                                "AF" => "Afghanistan",
                                "AL" => "Albania",
                                "DZ" => "Algeria",
                                "AS" => "American Samoa",
                                "AD" => "Andorra",
                                "AO" => "Angola",
                                "AI" => "Anguilla",
                                "AQ" => "Antarctica",
                                "AG" => "Antigua and Barbuda",
                                "AR" => "Argentina",
                                "AM" => "Armenia",
                                "AW" => "Aruba",
                                "AU" => "Australia",
                                "AT" => "Austria",
                                "AZ" => "Azerbaijan",
                                "BS" => "Bahamas",
                                "BH" => "Bahrain",
                                "BD" => "Bangladesh",
                                "BB" => "Barbados",
                                "BY" => "Belarus",
                                "BE" => "Belgium",
                                "BZ" => "Belize",
                                "BJ" => "Benin",
                                "BM" => "Bermuda",
                                "BT" => "Bhutan",
                                "BO" => "Bolivia",
                                "BA" => "Bosnia and Herzegovina",
                                "BW" => "Botswana",
                                "BV" => "Bouvet Island",
                                "BR" => "Brazil",
                                "IO" => "British Indian Ocean Territory",
                                "BN" => "Brunei Darussalam",
                                "BG" => "Bulgaria",
                                "BF" => "Burkina Faso",
                                "BI" => "Burundi",
                                "KH" => "Cambodia",
                                "CM" => "Cameroon",
                                "CA" => "Canada",
                                "CV" => "Cape Verde",
                                "KY" => "Cayman Islands",
                                "CF" => "Central African Republic",
                                "TD" => "Chad",
                                "CL" => "Chile",
                                "CN" => "China",
                                "CX" => "Christmas Island",
                                "CC" => "Cocos (Keeling) Islands",
                                "CO" => "Colombia",
                                "KM" => "Comoros",
                                "CG" => "Congo",
                                "CD" => "Congo, the Democratic Republic of the",
                                "CK" => "Cook Islands",
                                "CR" => "Costa Rica",
                                "CI" => "Cote D'Ivoire",
                                "HR" => "Croatia",
                                "CU" => "Cuba",
                                "CY" => "Cyprus",
                                "CZ" => "Czech Republic",
                                "DK" => "Denmark",
                                "DJ" => "Djibouti",
                                "DM" => "Dominica",
                                "DO" => "Dominican Republic",
                                "EC" => "Ecuador",
                                "EG" => "Egypt",
                                "SV" => "El Salvador",
                                "GQ" => "Equatorial Guinea",
                                "ER" => "Eritrea",
                                "EE" => "Estonia",
                                "ET" => "Ethiopia",
                                "FK" => "Falkland Islands (Malvinas)",
                                "FO" => "Faroe Islands",
                                "FJ" => "Fiji",
                                "FI" => "Finland",
                                "FR" => "France",
                                "GF" => "French Guiana",
                                "PF" => "French Polynesia",
                                "TF" => "French Southern Territories",
                                "GA" => "Gabon",
                                "GM" => "Gambia",
                                "GE" => "Georgia",
                                "DE" => "Germany",
                                "GH" => "Ghana",
                                "GI" => "Gibraltar",
                                "GR" => "Greece",
                                "GL" => "Greenland",
                                "GD" => "Grenada",
                                "GP" => "Guadeloupe",
                                "GU" => "Guam",
                                "GT" => "Guatemala",
                                "GN" => "Guinea",
                                "GW" => "Guinea-Bissau",
                                "GY" => "Guyana",
                                "HT" => "Haiti",
                                "HM" => "Heard Island and Mcdonald Islands",
                                "VA" => "Holy See (Vatican City State)",
                                "HN" => "Honduras",
                                "HK" => "Hong Kong",
                                "HU" => "Hungary",
                                "IS" => "Iceland",
                                "IN" => "India",
                                "ID" => "Indonesia",
                                "IR" => "Iran, Islamic Republic of",
                                "IQ" => "Iraq",
                                "IE" => "Ireland",
                                "IL" => "Israel",
                                "IT" => "Italy",
                                "JM" => "Jamaica",
                                "JP" => "Japan",
                                "JO" => "Jordan",
                                "KZ" => "Kazakhstan",
                                "KE" => "Kenya",
                                "KI" => "Kiribati",
                                "KP" => "Korea, Democratic People's Republic of",
                                "KR" => "Korea, Republic of",
                                "KW" => "Kuwait",
                                "KG" => "Kyrgyzstan",
                                "LA" => "Lao People's Democratic Republic",
                                "LV" => "Latvia",
                                "LB" => "Lebanon",
                                "LS" => "Lesotho",
                                "LR" => "Liberia",
                                "LY" => "Libyan Arab Jamahiriya",
                                "LI" => "Liechtenstein",
                                "LT" => "Lithuania",
                                "LU" => "Luxembourg",
                                "MO" => "Macao",
                                "MK" => "Macedonia, the Former Yugoslav Republic of",
                                "MG" => "Madagascar",
                                "MW" => "Malawi",
                                "MY" => "Malaysia",
                                "MV" => "Maldives",
                                "ML" => "Mali",
                                "MT" => "Malta",
                                "MH" => "Marshall Islands",
                                "MQ" => "Martinique",
                                "MR" => "Mauritania",
                                "MU" => "Mauritius",
                                "YT" => "Mayotte",
                                "MX" => "Mexico",
                                "FM" => "Micronesia, Federated States of",
                                "MD" => "Moldova, Republic of",
                                "MC" => "Monaco",
                                "MN" => "Mongolia",
                                "MS" => "Montserrat",
                                "MA" => "Morocco",
                                "MZ" => "Mozambique",
                                "MM" => "Myanmar",
                                "NA" => "Namibia",
                                "NR" => "Nauru",
                                "NP" => "Nepal",
                                "NL" => "Netherlands",
                                "AN" => "Netherlands Antilles",
                                "NC" => "New Caledonia",
                                "NZ" => "New Zealand",
                                "NI" => "Nicaragua",
                                "NE" => "Niger",
                                "NG" => "Nigeria",
                                "NU" => "Niue",
                                "NF" => "Norfolk Island",
                                "MP" => "Northern Mariana Islands",
                                "NO" => "Norway",
                                "OM" => "Oman",
                                "PK" => "Pakistan",
                                "PW" => "Palau",
                                "PS" => "Palestinian Territory, Occupied",
                                "PA" => "Panama",
                                "PG" => "Papua New Guinea",
                                "PY" => "Paraguay",
                                "PE" => "Peru",
                                "PH" => "Philippines",
                                "PN" => "Pitcairn",
                                "PL" => "Poland",
                                "PT" => "Portugal",
                                "PR" => "Puerto Rico",
                                "QA" => "Qatar",
                                "RE" => "Reunion",
                                "RO" => "Romania",
                                "RU" => "Russian Federation",
                                "RW" => "Rwanda",
                                "SH" => "Saint Helena",
                                "KN" => "Saint Kitts and Nevis",
                                "LC" => "Saint Lucia",
                                "PM" => "Saint Pierre and Miquelon",
                                "VC" => "Saint Vincent and the Grenadines",
                                "WS" => "Samoa",
                                "SM" => "San Marino",
                                "ST" => "Sao Tome and Principe",
                                "SA" => "Saudi Arabia",
                                "SN" => "Senegal",
                                "CS" => "Serbia and Montenegro",
                                "SC" => "Seychelles",
                                "SL" => "Sierra Leone",
                                "SG" => "Singapore",
                                "SK" => "Slovakia",
                                "SI" => "Slovenia",
                                "SB" => "Solomon Islands",
                                "SO" => "Somalia",
                                "ZA" => "South Africa",
                                "GS" => "South Georgia and the South Sandwich Islands",
                                "ES" => "Spain",
                                "LK" => "Sri Lanka",
                                "SD" => "Sudan",
                                "SR" => "Suriname",
                                "SJ" => "Svalbard and Jan Mayen",
                                "SZ" => "Swaziland",
                                "SE" => "Sweden",
                                "CH" => "Switzerland",
                                "SY" => "Syrian Arab Republic",
                                "TW" => "Taiwan, Province of China",
                                "TJ" => "Tajikistan",
                                "TZ" => "Tanzania, United Republic of",
                                "TH" => "Thailand",
                                "TL" => "Timor-Leste",
                                "TG" => "Togo",
                                "TK" => "Tokelau",
                                "TO" => "Tonga",
                                "TT" => "Trinidad and Tobago",
                                "TN" => "Tunisia",
                                "TR" => "Turkey",
                                "TM" => "Turkmenistan",
                                "TC" => "Turks and Caicos Islands",
                                "TV" => "Tuvalu",
                                "UG" => "Uganda",
                                "UA" => "Ukraine",
                                "AE" => "United Arab Emirates",
                                "GB" => "United Kingdom",
                                "US" => "United States",
                                "UM" => "United States Minor Outlying Islands",
                                "UY" => "Uruguay",
                                "UZ" => "Uzbekistan",
                                "VU" => "Vanuatu",
                                "VE" => "Venezuela",
                                "VN" => "Viet Nam",
                                "VG" => "Virgin Islands, British",
                                "VI" => "Virgin Islands, U.s.",
                                "WF" => "Wallis and Futuna",
                                "EH" => "Western Sahara",
                                "YE" => "Yemen",
                                "ZM" => "Zambia",
                                "ZW" => "Zimbabwe"
                            ];

                            ?>
                            <label class="col-sm-12">Sélectionnez un pays</label>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class="form-control form-control-line" name="country" id="v">
                                        <option value="">__sélectionnez__</option>
                                        <?php foreach ($countrys as $key => $country) { ?>
                                            <?php if (!empty($_POST['country']) && $_POST['country'] == $key || !empty($vaccin['country'])) { ?>
                                                <option value="<?= $key ?>" selected><?= $country ?></option>
                                            <?php } else { ?>
                                                <option value="<?= $key ?>"><?= $country ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                    <?= viewError($errors,'country') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <span>Vaccin obligatoire ?</span>
                                <div class="col-sm-12">
                                    <div>
                                        <input type="radio" id="obligatoire_false" name="obligatoire" value="0"
                                               checked>
                                        <label for="obligatoire_false">Non</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="obligatoire_true" name="obligatoire" value="1">
                                        <label for="obligatoire_true">Oui</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-md-12">Description</label>
                                <div class="col-sm-12">
                                    <textarea name="description" id="description" placeholder="<?= $vaccin['description'] ?>" class="form-control form-control-line" style="height: 200px; padding: 1rem"><?= recupInputValue('description')?></textarea>
                                    <?= viewError($errors,'description') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="laboratoire" class="col-md-12">Laboratoire</label>
                                <div class="col-sm-12">
                                    <input type="text" name="laboratoire" id="laboratoire" placeholder="<?= $vaccin['laboratoire'] ?>" value="<?= recupInputValue('laboratoire')?>" class="form-control form-control-line">
                                    <?= viewError($errors,'laboratoire') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input class="btn btn-success" type="submit" name="submitted" id="submitted" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include('inc/footer_back.php');