<?php  


/* Etape 4 - Contact.class.php */
/*
 * Une classe c'est en fait un plan à partir duquel on va pouvoir créer plusieurs objets
 * un peu comme un moule dont on en obtient comme objets des gâteaux
 *
 * Une classe peut contenir plusieurs méthodes (ou fonctions)
 * par ex. une classe voiture peut avoir comme méthodes 'freiner' et 'accélerer'
 * et quand je créé un objet de la classe voiture, par ex. un 308 ou une porsche qui auront les
 * fonctionnalités de la classe voiture comme 'freiner' et 'accélerer'
 */
 
 class Contact {
 	// déclaration des variables = champs de la table t_commentaire.sql
    private $c_nom;
    private $c_email;
    private $c_sujet;
    private $c_message;
    // Bonus - pour l'email
    private $to;
    private $headers;
    
    // fonction d'insertion en BDD
    public function insertContact($c_nom, $c_email, $c_sujet, $c_message) {
    	// on récupère les données rentrées par l'utilisateur
        $this->c_nom = strip_tags($c_nom);
		$this->c_email = strip_tags($c_email);
        $this->c_sujet = strip_tags($c_sujet);
        $this->c_message = strip_tags($c_message);
        
        // appelle la connexion à la BDD
        require('connexion.php');
        
        // on crée une requête puis on l'exécute
        $req = $bdd->prepare('INSERT INTO t_commentaire (c_nom, c_email, c_sujet, c_message) VALUES (:c_nom, :c_email, :c_sujet, :c_message)');
        $req->execute([
        	':c_nom'	=> $this->c_nom,//n attribue à la variable co_nom la valeur de l'objet en cours d'instanciation, le nom de l'auteur du message qui vient d'^tre posté
            ':c_email'	=> $this->c_email,
            ':c_sujet'	=> $this->c_sujet,
            ':c_message'=> $this->c_message]);
            
            // on ferme la requête pour protéger des injections
            $req->closeCursor();
    } 
    // Bonus - envoi d'un email
   public function sendEmail($c_sujet, $c_email, $c_message) {
       $this->to = 'sandra.herisson@lepoles.com';
       $this->c_email = strip_tags($c_email);
       $this->c_sujet = strip_tags($c_sujet);
       $this->c_message = strip_tags($c_message);
       $this->headers = 'From: ' . $this->c_email . "\r\n"; //retours à la ligne
       $this->headers .= 'MIME-version: 1.0' . "\r\n";
       $this->headers .= 'Content-type : text/html; charset=utf-8' . "\r\n";

       // on utilise la fonction mail() de PHP
       mail($this->to, $this->c_sujet, $this->c_message, $this->headers);
   }
}

 
    
 
 
 