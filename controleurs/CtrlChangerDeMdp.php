<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlAnnulerReservation.php : annulation d'une réservation
// Ecrit le 12/10/2015 par Jim

	if ( ! isset ($_POST ["newmdp1"]) == true || ! isset ($_POST ["newmdp2"]) == true) {
		// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$msgFooter = 'Changer de mot de passe';
		$themeFooter = $themeNormal;
		include_once ('vues/VueChangerDeMdp.php');
	}

	if ( empty ($_POST ["newmdp1"]) == true)  $mdp1 = "";  else   $mdp1 = $_POST ["newmdp1"];
	if ( empty ($_POST ["newmdp2"]) == true)  $mdp2 = "";  else   $mdp2 = $_POST ["newmdp2"];
	
	if ($mdp1 == '' || $mdp2 == '') {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueChangerDeMdp.php');
	}else {
		// connexion du serveur web à la base MySQL
		include_once ('modele/DAO.class.php');
		$dao = new DAO();

		// test de l'existence d'une réservation
		// la méthode existeReservation de la classe DAO retourne true si $nom existe, false s'il n'existe pas
		if ( $mdp1 == $mdp2 )  {
			// si le nom n'existe pas, retour à la vue
			$msgFooter = "Votre mot de passe a bien été changé et un mail vous a été envoyé !";
			$themeFooter = $themeNormal;
			$dao->modifierMdpUser($_SESSION['nom'], $mdp1);
			$dao->envoyerMdp($_SESSION['nom'], $mdp1);
			include_once ('vues/VueChangerDeMdp.php');
		}
		else {
			// annule la réservation du numéro suivant donné en paramètre
			$dao->annulerReservation($numero);
				
			$msgFooter = 'La confirmation est différente.';
			$themeFooter = $themeProbleme;
			include_once ('vues/VueChangerDeMdp.php');
				
		}
		unset($dao);		// fermeture de la connexion à MySQL
	}
