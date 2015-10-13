<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlConsulterReservations.php : traiter la demande de consultation de reservation
// Ecrit le 13/10/2015 par Adrien

	$nom = '';
	$msgFooter = 'Mot de passe oublié';
	$themeFooter = $themeNormal;
	include_once ('vues/VueDemanderMdp.php');


	// connexion du serveur web à la base MySQL
	include_once ('modele/DAO.class.php');
	$dao = new DAO();

	

//	if ($ok) {
		$themeFooter = $themeNormal;
		$msgFooter = 'Vous allez recevoir un mail<br>avec votre nouveau mot de passe.';
		include_once ('vues/VueConsulterReservation.php');
//	}
//	else {
//		$themeFooter = $themeProbleme;
//		$msgFooter = "Echec lors de l'envoi du mail !";
//		include_once ('vues/VueDemanderMdp.php');
//	}
	
	unset($dao);		// fermeture de la connexion à MySQL
	
