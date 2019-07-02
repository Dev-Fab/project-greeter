<?php
require_once 'class/Cfg.php';
$tabErreur = [];
$user = new User();
// Arrivée en POST après validation du formulaire.
if (filter_input(INPUT_POST, 'submit')) {
	$user->log = filter_input(INPUT_POST, 'log', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	$user->mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if (!$user->log) {
		$tabErreur[] = "Identifiant absent";
	}
	if (!$user->mdp) {
		$tabErreur[] = "Mot de passe absent";
	}
	if (!$tabErreur && $user->login()) {
		header('Location:index.php');
		exit;
	}
	$tabErreur[] = "Identifiant ou mot de passe invalide";
}
$user = null;
?>
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
        <link rel="icon" type="image/png" href="img/favicon-greeter.png" />
    </head>

    <body>
        <?php require_once 'header.php' ?>
        
        <div class="wrapper">
        <div class="container border-right border-left bg-white pb-3">

           
           <form name="form1" action="login.php" method="post">
				<div class="item">
					<label>Identifiant</label>
					<input name="log" maxlength="10" required="required"/>
				</div>
				<div class="item">
					<label>Mot de passe</label>
					<input type="password" name="mdp" size="10" maxlength="10" required="required"/>
				</div>
				<div class="item">
					<label></label>
					<input type="submit" name="submit" value="Valider"/>
				</div>
			</form>

        </div>
        <?php require_once 'footer.php' ?>
                    </div>
    </body>

</html>