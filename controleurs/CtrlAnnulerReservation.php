<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlAnnulerReservation.php : annulation d'une réservation
// Ecrit le 12/10/2015 par Jim

	if ( ! isset ($_POST ["numero"]) == true) {
		// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$msgFooter = 'Annuler une réservation';
		$themeFooter = $themeNormal;
		include_once ('vues/VueAnnulerReservation.php');
	}

	if ( empty ($_POST ["numero"]) == true)  $numero = "";  else   $numero = $_POST ["numero"];
	if ($numero == '') {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueAnnulerReservation.php');
	}
	else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();

		// test de l'existence d'une réservation
		// la méthode existeReservation de la classe DAO retourne true si $nom existe, false s'il n'existe pas
		if ( ! $dao->existeReservation($numero) )  {
			// si le nom n'existe pas, retour à la vue
			$msgFooter = "Numéro réservation inexistant !";
			$themeFooter = $themeProbleme;
			include_once ('vues/VueAnnulerReservation.php');
		}
		else {
			// annule la réservation du numéro suivant donné en paramètre
			$dao->annulerReservation($numero);
				
			$msgFooter = 'La réservation a été annulé.';
			$themeFooter = $themeNormal;
			include_once ('vues/VueAnnulerReservation.php');
				
		}
		unset($dao);		// fermeture de la connexion à MySQL
	}
