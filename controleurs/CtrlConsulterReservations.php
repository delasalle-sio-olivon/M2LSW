<?php
// Projet Réservations M2L - version web mobile
// Fonction du contrôleur CtrlConsulterReservations.php : traiter la demande de consultation de reservation
// Ecrit le 13/10/2015 par Adrien
	$msgFooter = '';
	$themeFooter = $themeNormal;

	// connexion du serveur web à la base MySQL
	include_once ('modele/DAO.class.php');
	$dao = new DAO();
	$dao->creerLesDigicodesManquants();
	$listeRes = $dao->listeReservations($_SESSION['nom']);
	$themeFooter = $themeNormal;
	if (count($listeRes)>0) {
		$msgFooter = "Vous avez ". count($listeRes) ." réservation(s)!";
	}
	else {
		$msgFooter = "Vous n'avez aucune réservation!";
	}
	include_once ('vues/VueConsulterReservations.php');
	unset($dao);		// fermeture de la connexion à MySQL