<?php
error_reporting(E_ALL);
/*
	********************************************************************************************
	CONFIGURATION
	********************************************************************************************
*/
// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
$destinataire = 'contact@relookingkenitra.com';
 
// copie ? (envoie une copie au visiteur)
$copie = 'oui'; // 'oui' ou 'non'
 
// Messages de confirmation du mail
$message_envoye = "Votre message nous est bien parvenu !";
$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";
 
/*
	********************************************************************************************
	FIN DE LA CONFIGURATION
	********************************************************************************************
*/

	/*
	 * cette fonction sert à nettoyer et enregistrer un texte
	 */
	function Rec($text)
	{
		$text = htmlspecialchars(trim($text), ENT_QUOTES);
		if (1 === get_magic_quotes_gpc())
		{
			$text = stripslashes($text);
		}
 
		$text = nl2br($text);
		return $text;
	};
 
	/*
	 * Cette fonction sert à vérifier la syntaxe d'un email
	 */
	function IsEmail($email)
	{
		$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
		return (($value === 0) || ($value === false)) ? false : true;
	}
 
	// formulaire envoyé, on récupère tous les champs.
	$nom     = (isset($_POST['InputName']))     ? Rec($_POST['InputName'])     : '';
	$prenom  = (isset($_POST['InputLast']))     ? Rec($_POST['InputLast'])     : '';
	$email   = (isset($_POST['InputEmail']))    ? Rec($_POST['InputEmail'])    : '';
	$objet   = (isset($_POST['InputNumber']))   ? Rec($_POST['InputNumber'])   : '';
	$message = (isset($_POST['InputMessage']))  ? Rec($_POST['InputMessage'])  : '';
 
	// les 4 variables sont remplies, on génère puis envoie le mail
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'From:'.$nom.' '.$prenom. ' <'.$email.'>' . "\r\n" .
					'Reply-To:'.$email. "\r\n" .
					'X-Mailer:PHP/'.phpversion();
 
	// envoyer une copie au visiteur ?
	if ($copie == 'non')
	{
		$cible = $destinataire.','.$email;
	}
	else
	{
		$cible = $destinataire;
	};
 
	// Remplacement de certains caractères spéciaux
	$message = str_replace("&#039;","'",$message);
	$message = str_replace("&#8217;","'",$message);
	$message = str_replace("&quot;",'"',$message);
	$message = str_replace('<br>','',$message);
	$message = str_replace('<br />','',$message);
	$message = str_replace("&lt;","<",$message);
	$message = str_replace("&gt;",">",$message);
	$message = str_replace("&amp;","&",$message);
 
	// Envoi du mail
	if (mail($cible, $objet, $message, $headers))
	{
		echo '<p>'.$message_envoye.'</p>'."\n";
	}
	else
	{
		echo '<p>'.$message_non_envoye.'</p>'."\n";
	};
		
?>