<?php
//Formulaire/index.php
// on récupère la classe Contact
require('Contact.class.php');

// on vérifie que le formulaire a été posté
if (!empty($_POST)) {
    // on éclate le $_POST en tableau qui permet d'accéder directement aux champs par des variables
    extract($_POST);
    //var_dump($_POST);
    // on effectue une validation des données du formulaire et on vérifie la validité de l'email
    $valid = (empty($c_nom) || empty($c_email) || !filter_var($c_email, FILTER_VALIDATE_EMAIL) || empty($c_sujet) || empty($c_message)) ? false : true; // écriture ternaire pour if / else
    $erreurnom = (empty($c_nom)) ? 'Indiquez votre nom' : null;
    $erreuremail = (empty($c_email) || !filter_var($c_email, FILTER_VALIDATE_EMAIL)) ? 'Entrez un email valide' : null;
    $erreursujet = (empty($c_sujet)) ? 'Indiquez un sujet' : null;
    $erreurmessage = (empty($c_message)) ? 'Parlez donc !!' : null;
    // si tous les champs sont correctement renseignés
    if ($valid) {
        // on crée un nouvel objet (ou une instance) de la class Contact.class.php
        $contact = new Contact();
        // on utilise la méthode insertContact pour insérer en BDD
        $contact->insertContact($c_nom, $c_email, $c_sujet, $c_message);
    }
}
// on utilise la méthode sendMail de la classe Contact.class.php
//$contact->sendEmail($c_sujet, $c_email, $c_message);

// on efface les valeurs du formulaires
unset($c_nom);
unset($c_sujet);
unset($c_message);
unset($c_email);
unset($c_contact);

// on créé une variable de succès
$success = 'Message envoyé !';


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!--responsive viewport meta tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Formulaire de contact</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="grass.jpg" alt="photo de nature" style="height: 71vh; width: 27vw; border-radius: 1%">
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-6 offset-2">
                        <h3>Formulaire de contact</h3>
                        <h5>Réalisé en POO</h5>
                        <!-- BONUS EMAIL -->
                           <?php if (isset($success)): ?>
                               <div class="alert alert-success" role="alert"><?= $success; ?></div>
                           <?php endif ?>
                           <!-- FIN BONUS EMAIL -->
                        <form action="index.php" method="POST">
                            <div class="form-group">
                                <label for="nom">Nom :</label>
                                <span class="error"><?php if (isset($erreurnom)) echo $erreurnom; ?></span>
                                <input class="form-control" type="text" name="c_nom" value="<?php if(isset($c_nom)) echo $c_nom; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <span class="error"><?php if (isset($erreuremail)) echo $erreuremail; ?></span>
                                <input id="email" class="form-control" type="text" name="c_email" value="<?php if (isset($c_email)) echo $c_email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="sujet">Sujet :</label>
                                <span class="error"><?php if (isset($erreursujet)) echo $erreursujet; ?></span>
                                <input class="form-control" type="text" name="c_sujet" value="<?php if (isset($c_sujet)) echo $c_sujet; ?>">
                            </div>
                            <div class="form-group">
                                <label for="message">Message :</label>
                                <span class="error"><?php if (isset($erreurmessage)) echo $erreurmessage; ?></span>
                                <textarea class="form-control" name="c_message" cols="30" rows="10"><?php if (isset($c_message)) echo $c_message; ?></textarea>
                            </div>

                            <input type="submit" class="btn btn-outline-info btn-block btnsubmit" value="Envoyer" />
                        </form><!-- /form -->
                    </div><!-- /.col-md-6 offset-2-->
                </div><!-- /.row -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!--/.container -->



    <!-- JS for Bootstrap -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


    
















</body>
</html>
