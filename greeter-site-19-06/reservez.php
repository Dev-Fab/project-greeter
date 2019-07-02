<?php 
require_once 'class/Cfg.php';

/*
if (!$user = User::getUserSession()) {
	header('Location:login.php');
	exit;
}
*/

$tabLieu = Lieu::tab(1, "nom");
$tabGreeter = Greeter::tab(1, "nom");
$jsonGreeter = json_encode($tabGreeter);
$reservation = new Reservation();

//Création du fichier json dynamique qui récupère toutes les infos des greeters pour l'afficher via Ajax
$fichier = fopen("list-greeter.json", "w+");
fwrite($fichier, $jsonGreeter);
fclose($fichier);




/*
if (filter_input(INPUT_POST, 'submit')) {
    $reservation->id_greeter = filter_input(INPUT_POST, 'id_greeter', FILTER_VALIDATE_INT, $opt);
    $reservation->id_user = filter_input(INPUT_POST, 'id_user', FILTER_VALIDATE_INT, $opt);
    $reservation->date_debut = filter_input(INPUT_POST, 'date_debut', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);




$reservation->sauver();
		header("Location:index.php");
        exit;
}

*/
/* VALIDATION DE LA DATE ET CONVERSION POUR ENVOYER VERS DB mettre aussi que $time > date('Y-m-d')
$time = strtotime($_POST['dateFrom']);
if ($time) {
  $new_date = date('Y-m-d', $time);
  echo $new_date;
} else {
   echo 'Invalid Date: ' . $_POST['dateFrom'];
  // fix it.
}
*/

// REQUETE POUR LA RESEVATION : INSERT INTO reservation (date_debut, id_greeter, id_touriste) VALUES (NOW(), '3', '4');

?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <title><?= Cfg::APP_TITRE ?></title>
        
    
        
        <link rel="stylesheet" href="css/style.css" />

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>

    </head>

    <body>
        <?php require_once 'header.php' ?>
    <div class="wrapper">
        <div class="container bg-white pb-3">

            <br />
            
            <h2 class="ml-3">Réservez une visite avec un greeter</h2>
            <br />
            <form name="formReservation" method="POST" action="reservez.php" enctype="multipart/form-data">
            <div class="row col-md-3 mx-auto mb-5">
                <label for="villes">Sélectionnez votre ville :</label>
                <select id="step1" class="step">
                <option value="" selected>Choisir une ville</option>
                     <?php foreach ($tabLieu as $lieu) {
            ?>
                    <option value="<?= $lieu->id_lieu ?>">
                        <?= $lieu->nom ?>
                    </option>
                    <?php
                }
                ?> 
                </select>
            </div>
            
            <div class="row col-md-3 mx-auto">
                
                
                <label for="greeter">Sélectionnez votre greeter :</label>
                <select id="step2" class="step" disabled >
                    <option value="" selected />Choisir un greeter</option>
                 
                </select>
            </div>
            
            <div class="row col-md-3 mx-auto mt-5">
              
                <label for="date">Sélectionnez votre date :</label>
                <input type="date" class="step" id="step3" min="<?= date('Y-m-d'); ?>" max=<?= date('Y-m-d', strtotime('+1 years')); ?> disabled value="<?= date('Y-m-d'); ?>" name="reservation">
                
            </div>
            
            <div class="row col-md-3 mx-auto mt-5">
                   
                    <input type="button" class="mr-5" value="Annuler" onclick="annuler()"/>   <input type="submit" name="submit" value="Valider"/>
                </div>
            </form>
            </div>
            
        </div>
            
            </div>
            <?php require_once 'footer.php' ?>

            <script src="js/calendar.js"></script>
            <script src="js/test.js"></script>
    </body>

</html>