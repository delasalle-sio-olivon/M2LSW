<?php
// Service web du projet Réservations M2L
// Ecrit le 21/5/2015 par Jim

// Ce service web permet à un utilisateur de consulter ses réservations à venir
// et fournit un flux XML contenant un compte-rendu d'exécution

// Le service web doit recevoir 2 paramètres : nom, mdp
// Les paramètres peuvent être passés par la méthode GET (pratique pour les tests, mais à éviter en exploitation) :
//     http://<hébergeur>/ConsulterReservations.php?nom=zenelsy&mdp=passe
// Les paramètres peuvent être passés par la méthode POST (à privilégier en exploitation pour la confidentialité des données) :
//     http://<hébergeur>/ConsulterReservations.php

// déclaration des variables globales pour pouvoir les utiliser aussi dans les fonctions
global $doc;		// le document XML à générer
global $nom, $numRes;

// inclusion de la classe Outils
include_once ('../modele/Outils.class.php');
// inclusion des paramètres de l'application
include_once ('../modele/include.parametres.php');

// crée une instance de DOMdocument 
$doc = new DOMDocument();

// specifie la version et le type d'encodage
$doc->version = '1.0';
$doc->encoding = 'ISO-8859-1';
  
// crée un commentaire et l'encode en ISO
$elt_commentaire = $doc->createComment('Service web ConsulterReservations - BTS SIO - Lycée De La Salle - Rennes');
// place ce commentaire à la racine du document XML
$doc->appendChild($elt_commentaire);
	
// Récupération des données transmises
// la fonction $_GET récupère une donnée passée en paramètre dans l'URL par la méthode GET
if ( empty ($_GET ["nom"]) == true)  $nom = "";  else   $nom = $_GET ["nom"];
if ( empty ($_GET ["mdp"]) == true)  $mdp = "";  else   $mdp = $_GET ["mdp"];
if ( empty ($_GET ["numRes"]) == true)  $numRes = "";  else   $numRes = $_GET ["numRes"];
// si l'URL ne contient pas les données, on regarde si elles ont été envoyées par la méthode POST
// la fonction $_POST récupère une donnée envoyées par la méthode POST
if ( $nom == "" && $mdp == "" && $numRes == "" )
{	if ( empty ($_POST ["nom"]) == true)  $nom = "";  else   $nom = $_POST ["nom"];
	if ( empty ($_POST ["mdp"]) == true)  $mdp = "";  else   $mdp = $_POST ["mdp"];
	if ( empty ($_POST ["numRes"]) == true)  $numRes = "";  else   $numRes = $_POST ["numRes"];
}
  
// Contrôle de la présence des paramètres
if ( $nom == "" || $mdp == "" || $numRes == "" )
{	TraitementAnormal ("Erreur : données incomplètes.");
}
else
{	// connexion du serveur web à la base MySQL ("include_once" peut être remplacé par "require_once")
	include_once ('../modele/DAO.class.php');
	$dao = new DAO();
	
	if ( $dao->getNiveauUtilisateur($nom, $mdp) == "inconnu" )
		TraitementAnormal("Erreur : authentification incorrecte.");
	else 
	{	
		if ($dao->existeReservation($numRes)){
			if ($dao->estLeCreateur($nom, $numRes)){
				$res = $dao->getReservation($numRes);
				if ($res->getStatus() == "4"){
					if ($res->getEnd_time() > time()){
						TraitementNormal($res->getDigicode(),$numRes);
					}else{
						TraitementAnormal("Erreur : cette réservation est déjà passée.");
					}
					
				}else{
					TraitementAnormal("Erreur : cette réservation est déjà confirmée.");
				}
				
				
			}else{
				TraitementAnormal("Erreur : vous n'êtes pas l'auteur de cette réservation.");
			}
			
			
			
		}else{
			TraitementAnormal("Erreur : numéro de réservation inexistant.");
		}
		
	}
	// ferme la connexion à MySQL
	unset($dao);
	}
// Mise en forme finale   
$doc->formatOutput = true;  
// renvoie le contenu XML
echo $doc->saveXML();
// fin du programme
exit;


// fonction de traitement des cas anormaux
function TraitementAnormal($msg)
{	// redéclaration des données globales utilisées dans la fonction
	global $doc;
	// crée l'élément 'data' à la racine du document XML
	$elt_data = $doc->createElement('data');
	$doc->appendChild($elt_data);
	// place l'élément 'reponse' juste après l'élément 'data'
	$elt_reponse = $doc->createElement('reponse', $msg);
	$elt_data->appendChild($elt_reponse);
	return;
}
 

// fonction de traitement des cas normaux
function TraitementNormal($digicode, $numRes)
{	// redéclaration des données globales utilisées dans la fonction
	global $doc;
	global $nom;

	// crée l'élément 'data' à la racine du document XML
	$elt_data = $doc->createElement('data');
	$doc->appendChild($elt_data);
	// place l'élément 'reponse' juste après l'élément 'data'
	$elt_reponse = $doc->createElement('reponse', "Enregistrement effectué ; vous allez recevoir un mail de confirmation.");
	$elt_data->appendChild($elt_reponse);
	
	$elt_donnees = $doc->createElement('donnees');
	$elt_data->appendChild($elt_donnees);	
	
	// traitement de la confirmation
	$dao = new DAO();
	$dao->confirmerReservation($numRes);
	
	$message = "La réservation à bien été enregitré le digicode est : " . $digicode;
	$user = $dao->getUtilisateur($nom);
	$email = $user->getEmail();
	Outils::envoyerMail ($email, "Confirmation réservation", $message, "delasalle.sio.crib@gmail.com");
	return;
}
?>
