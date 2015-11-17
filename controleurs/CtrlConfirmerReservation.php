<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlConsulterReservations.php : traiter la demande de consultation de reservation
// Ecrit le 13/10/2015 par Adrien
if ( ! isset ($_POST ["numero"]) == true) {
		// si les données n'ont pas été postées, c'est le premier appel du formulaire : affichage de la vue sans message d'erreur
		$msgFooter = 'Confirmer une réservation';
		$themeFooter = $themeNormal;
		include_once ('vues/VueConfirmerReservation.php');
	}

	if ( empty ($_POST ["numero"]) == true)  $numero = "";  else   $numero = $_POST ["numero"];
	if ($numero == '') {
		// si les données sont incomplètes, réaffichage de la vue avec un message explicatif
		$msgFooter = 'Données incomplètes !';
		$themeFooter = $themeProbleme;
		include_once ('vues/VueConfirmerReservation.php');
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
			include_once ('vues/VueConfirmerReservation.php');
		}
		else {
			if($dao->estLeCreateur($_SESSION["nom"], $numero)){
				$dao->creerLesDigicodesManquants();
				$res = $dao->getReservation($numero);
				if($res->getStatus() == 4){
					if($res->getEnd_time()<time()){
						$msgFooter = "Cette réservation est déjà passée.";
						$themeFooter = $themeProbleme;
					}else{
						// annule la réservation du numéro suivant donné en paramètre
						$dao->confirmerReservation($numero);
						$msgFooter = 'La réservation a été confirmée.';
						$themeFooter = $themeNormal;
					}
				}else{
					$msgFooter = "Cette réservation est déjà confirmée.";
					$themeFooter = $themeProbleme;
				}
			}else{
				$msgFooter = "Vous n'êtes pas l'auteur de cette réservation.";
				$themeFooter = $themeProbleme;
			}
			include_once ('vues/VueConfirmerReservation.php');
		}
		
		unset($dao);		// fermeture de la connexion à MySQL
	}
