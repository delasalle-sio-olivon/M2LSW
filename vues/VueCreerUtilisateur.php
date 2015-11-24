<?php
	// Projet Réservations M2L - version web mobile
	// Fonction de la vue VueDemanderMdp.php : visualiser la vue de demande d'envoi d'un nouveau mot de passe
	// Ecrit le 12/10/2015 par Jim
?>
<!doctype html>
<html>
	<head>
		<?php include_once ('vues/head.php'); ?>
	</head> 
	<body>
		<div data-role="page">
			<div data-role="header" data-theme="<?php echo $themeNormal; ?>">
				<h4>M2L-GRR</h4>
				<a href="index.php?action=Menu">Retour</a>
			</div>
			<div data-role="content">
				<h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px;">Créer un utilisateur</h4>
				<form name="form1" id="form1" action="index.php?action=CreerUtilisateur" method="post">
					<div data-role="fieldcontain" class="ui-hide-label">
						<input type="text" name="nom" id="nom" placeholder="Entrez le nom" value="<?php echo $nom; ?>" >
					</div>
					<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
						<fieldset data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-vertical" aria-disabled="false" data-disabled="false" data-shadow="false" data-corners="true" data-exclude-invisible="true" data-type="vertical" data-mini="false" data-init-selector=":jqmData(role='controlgroup')"><div role="heading" class="ui-controlgroup-label"><legend>Niveau :</legend></div>
						<div class="ui-controlgroup-controls">
							<div class="ui-radio"><input type="radio" name="level" id="invite" value="0" data-mini="true" <?php if ($lvl == "0") echo ('checked="checked"'); ?>"><label for="invite" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="radio-on" data-theme="c" data-mini="true" class="ui-radio-on ui-btn ui-btn-up-c ui-btn-corner-all ui-mini ui-btn-icon-left ui-first-child"><span class="ui-btn-inner"><span class="ui-btn-text">Invité</span><span class="ui-icon ui-icon-radio-on ui-icon-shadow"></span></span></label></div>
							<div class="ui-radio"><input type="radio" name="level" id="utilisateur" value="1" data-mini="true" <?php if ($lvl == "1") echo ('checked="checked"'); ?>><label for="utilisateur" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="radio-off" data-theme="c" data-mini="true" class="ui-radio-off ui-btn ui-btn-up-c ui-btn-corner-all ui-mini ui-btn-icon-left"><span class="ui-btn-inner"><span class="ui-btn-text">Utilisateur</span><span class="ui-icon ui-icon-radio-off ui-icon-shadow"></span></span></label></div>
							<div class="ui-radio"><input type="radio" name="level" id="administrateur" value="2" data-mini="true" <?php if ($lvl == "2") echo ('checked="checked"'); ?>><label for="administrateur" data-corners="true" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-icon="radio-off" data-theme="c" data-mini="true" class="ui-radio-off ui-btn ui-btn-up-c ui-btn-corner-all ui-mini ui-btn-icon-left ui-last-child"><span class="ui-btn-inner"><span class="ui-btn-text">Administrateur</span><span class="ui-icon ui-icon-radio-off ui-icon-shadow"></span></span></label></div>
							
						</div></fieldset></div>
						
						
					<div data-role="fieldcontain" class="ui-hide-label">
						<input type="text" name="mail" id="mail" placeholder="Entrez l'adresse e-mail" value="<?php echo $mail; ?>" >
					</div>
					<div data-role="fieldcontain">
						<input type="submit" name="creerUtilisateur" id="creerUtilisateur" value="Créer un utilisateur">
					</div>
				</form>
			</div>
			<div data-role="footer" data-position="fixed" data-theme="<?php echo $themeFooter; ?>">
				<h4><?php echo $msgFooter; ?></h4>
			</div>
		</div>
	</body>