<?php
$connected = false;
$get_login = "";
$error = "";

if(isset($_POST["login"]) && isset($_POST["password"]))
{
    $login = $_POST["login"];
	$password = $_POST["password"];
	$get_login = "&login=".urlencode($login);
	
	//Vérifications des inputs
    if(checkLogin($login))
    {
        if(checkPassword($password))
        {
            // Si le login existe déjà
            if(loginExist($login))
            { 
                $error = "&error=".urlencode("Ce login est déjà pris.");
			}
			else
			{
				if(createUser($login,$password,SUBSCRIBER))
				{
					$message = "&message=".urlencode("Inscription réussie!");
					$connected = true;
				}
				else
				{
					$error = "&error=".urlencode("Une erreur est survenue lors de l'insertion.");
				}
			}
		}
		else
		{
			$error = "&error=".urlencode("Password incorrect.");
		}
	}
	else
	{
		$error = "&error=".urlencode("Login incorrect.");
	}
}

if($connected)
{
	//TODO Connecter puis renvoyer vers la page d'accueil ou la page précédente ou une page dédiée avec un message de bienvenue
	include "service_login.php";
}
else
{
    header("Location: ?page=subscribe".$get_login.$error);
}
?>