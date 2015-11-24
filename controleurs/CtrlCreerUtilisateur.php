<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlAnnulerReservation.php : annulation d'une réservation
// Ecrit le 12/10/2015 par Jim

	if ( ! isset ($_POST ["nom"]) == true || ! isset ($_POST ["level"]) == true || ! isset ($_POST ["mail"]) == true) {
		// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$msgFooter = 'Créer un utilisateur';
		$themeFooter = $themeNormal;
		include_once ('vues/VueCreerUtilisateur.php');
	}

	if ( empty ($_POST ["nom"]) == true)  $nom = "";  else   $nom = $_POST ["nom"];
	if ( empty ($_POST ["level"]) == true)  $lvl = "";  else   $lvl = $_POST ["level"];
	if ( empty ($_POST ["mail"]) == true)  $mail = "";  else   $mail = $_POST ["mail"];
	
	if ($nom == ''||$lvl == ''||$mail == '') {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueCreerUtilisateur.php');
	} else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();

		// test de l'existence d'une réservation
		// la méthode existeReservation de la classe DAO retourne true si $nom existe, false s'il n'existe pas
		if ( $dao->existeUtilisateur($nom))  {
			// si le nom n'existe pas, retour à la vue
			$msgFooter = "Utilisateur créer!";
			$dao->enregistrerUtilisateur($nom, $lvl, $dao->genererUnDigicode(), $mail);
			include_once ('vues/VueCreerUtilisateur.php');
		}
		else {
			// annule la réservation du numéro suivant donné en paramètre
			$msgFooter = "Cet utilisateur éxite déjà.";
			$themeFooter = $themeProbleme;
			include_once ('vues/VueCreerUtilisateur.php');
				
		}
		unset($dao); // fermeture de la connexion à MySQL
	}
