<?php
/* Partie User */
// SELECT

function getUser($id){
    global $pdo;
    $sql = "SELECT * FROM psv_user WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id);
    $query->execute();
    return $query->fetch();
}

function getNombreUsers(){
    global $pdo;
    $sql = "SELECT COUNT(psv_user.id) as userTotal FROM psv_user; ";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetch();
}

function getAllIdUsers(){
    global $pdo;
    $sql = "SELECT id FROM psv_user";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

function emailValidationBdd($email)
{
    global $pdo;
    $sql = "SELECT * FROM psv_user WHERE email = :email";/*select= sectionne * = prend tous from= qui provient de la table choisi where= condition, si l'email correspond bien a l'email renseigne dans l'inscription*/
    $query = $pdo->prepare($sql); /*ont prepare la requete*/
    $query->bindValue(':email',$email,PDO::PARAM_STR); /*pour proteger avec les : pdo est la pour rerrifier si il n'a pas de parametre bizarre et que ca soit bien une chaine de caractere*/
    $query->execute();
    return $query->fetch();
}
function pseudoValidationBdd($pseudo)
{
    global $pdo;
    $sql2 = "SELECT * FROM psv_user WHERE pseudo = :pseudo";
    $query =$pdo->prepare($sql2);
    $query->bindValue(':pseudo',$pseudo,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}
/*fonction login*/
function selectEmailOrPseudo($login)
{
    global $pdo;
    $sql = "SELECT * FROM psv_user WHERE email = :login OR pseudo = :login";
    $query = $pdo->prepare($sql);
    $query->bindValue(':login',$login,PDO::PARAM_STR);
    $query->execute();
    return $query->fetch();
}

// INSERT
function putNewUser(string $nom,string $prenom,string $age,string $email, string $token, string $password, string $pseudo){
    global $pdo;
    $sql = "INSERT INTO `psv_user`(nom, prenom, age ,email, created_at, token, password, role, pseudo) 
            VALUES (:nom,:prenom,:age,:email,NOW(),:token,:password,'user',:pseudo)";
    $query = $pdo->prepare($sql);
    $query->bindValue(':nom',$nom);
    $query->bindValue(':prenom',$prenom);
    $query->bindValue(':age',$age);
    $query->bindValue(':email',$email);
    $query->bindValue(':token',$token);
    $query->bindValue(':password',$password);
    $query->bindValue(':pseudo',$pseudo);
    $query->execute();
    header('location: login.php');
}
// UPDATE


/* Partie vaccins */

// SELCT
function getAllVaccinName(): array
{
    global $pdo;
    $sql = "SELECT `libelle` FROM `psv_vaccin`";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_COLUMN);
}

function getAllVaccin(){
    global $pdo;
    $sql = "SELECT * FROM `psv_vaccin` WHERE 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}
function getMoisRappel(int $id):array
{
    global $pdo;
    $sql = "SELECT `temps_rappel` FROM `psv_vaccin` WHERE `id` = :id";
    $query = $pdo->prepare($sql);
    $query->bindValue(':id',$id,PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

function getVaccin($idVaccin){
    global $pdo;
    $sql = "SELECT `libelle`,`obligatoire`,`description` FROM `psv_vaccin` WHERE id = :idVaccin";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idVaccin',$idVaccin,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
}

// INSERT

// UPDATE


/* Partie carnet */

// SELCT

function getVaccinsUser(int $idUser):array
{
    global $pdo;

    $sql = "SELECT `id_vaccin` FROM `psv_carnet` WHERE `id_user` = :idUser;";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_COLUMN);
}

function getNombreUserCarnet(){
    global $pdo;
    $sql = "SELECT COUNT(DISTINCT psv_carnet.id_user) as UserCarnet FROM psv_carnet;";
    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetch();
}

function getNumberUsersVacinateByVaccin($idVaccin){
    global $pdo;
    $sql = "SELECT COUNT(id_vaccin) AS nombrePersonneVaccin FROM `psv_carnet` WHERE id_vaccin = :idVaccin";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idVaccin',$idVaccin,PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

function getInfoVaccinUser($idUser){
    global $pdo;
    $sql = "SELECT id_vaccin, premiere_date, date_prochain FROM `psv_carnet` WHERE id_user = :idUser";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
}
function getVaccinsUserByCarnet($idUser){
    global $pdo;
    $sql = "SELECT psv_carnet.id,psv_carnet.premiere_date,psv_carnet.date_prochain, psv_vaccin.libelle, psv_vaccin.pays, psv_vaccin.obligatoire, psv_vaccin.description,psv_vaccin.Laboratoire,psv_vaccin.temps_rappel as mois,psv_vaccin.id as idVaccin
    FROM psv_carnet INNER JOIN psv_vaccin ON psv_carnet.id_vaccin = psv_vaccin.id WHERE psv_carnet.id_user = :idUser"  ;
    $query = $pdo->prepare($sql);
    $query->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll();
}


// INSERT

function putNewVaccinOnCarnet( int $idVaccin,int $idUser, string $date, int $mois):void
{
    global $pdo;
    $sql = "
        INSERT INTO `psv_carnet`(`id_vaccin`, `id_user`, `premiere_date`, `date_prochain`) 
        VALUES (:idVaccin,:idUser,:date,DATE_ADD(:date,INTERVAL +:mois MONTH))
        ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idVaccin',$idVaccin,PDO::PARAM_INT);
    $query->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $query->bindValue(':date',$date);
    $query->bindValue(':mois',$mois,PDO::PARAM_INT);
    $query->execute();
}


// UPDATE
function carnetAccutualizeByUser(int $idCarnet, int $mois):void
{
    global $pdo;
    $sql = "UPDATE `psv_carnet`
            SET `premiere_date`= NOW(), `date_prochain` = DATE_ADD(`premiere_date`,INTERVAL +:mois MONTH)
            WHERE id = :idCarnet
        ";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idCarnet',$idCarnet,PDO::PARAM_INT);
    $query->bindValue(':mois',$mois,PDO::PARAM_INT);
    $query->execute();
}


// statistique

function statNombreUserVaccine(int $idVaccin):array
{
    global $pdo;
    $sql="SELECT COUNT(id_vaccin)as nombre, libelle as vaccin
          FROM psv_carnet 
          INNER JOIN psv_vaccin ON psv_carnet.id_vaccin = psv_vaccin.id 
          WHERE psv_carnet.id_vaccin =:idVaccin";
    $query = $pdo->prepare($sql);
    $query->bindValue(':idVaccin',$idVaccin,PDO::PARAM_INT);
    $query->execute();
    return $query->fetchAll()[0];
}
