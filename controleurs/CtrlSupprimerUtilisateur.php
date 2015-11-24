<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlAnnulerReservation.php : annulation d'une réservation
// Ecrit le 12/10/2015 par Jim

	if ( ! isset ($_POST ["nom"]) == true ) {
		// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$nom = "";
		$msgFooter = 'Supprimer un utilisateur';
		$themeFooter = $themeNormal;
		include_once ('vues/VueSupprimerUtilisateur.php');
	}

	if ( empty ($_POST ["nom"]) == true)  $nom = "";  else   $nom = $_POST ["nom"];
		
	if ($nom == '') {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueSupprimerUtilisateur.php');
	}else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();

		// test de l'existence d'une réservation
		// la méthode existeReservation de la classe DAO retourne true si $nom existe, false s'il n'existe pas
		if ( $dao->existeUtilisateur($nom))  {
			// si le nom n'existe pas, retour à la vue
			$dao->supprimerUtilisateur($nom);
			$msgFooter = "Utilisateur supprimé!";

			include_once ('vues/VueSupprimerUtilisateur.php');
		}else {
			// annule la réservation du numéro suivant donné en paramètre
			$msgFooter = "Cet utilisateur n'éxiste pas.";
			$themeFooter = $themeProbleme;
			include_once ('vues/VueSupprimerUtilisateur.php');
				
		}
		unset($dao); // fermeture de la connexion à MySQL
	}
