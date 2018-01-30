<?php
$connected = false;
$get_login = "";

if(isset($_POST["login"]) && isset($_POST["password"]))
{
    $get_login = "&login=".$_POST["login"];
    $login = $_POST["login"];
    $password = $_POST["password"];

    //Vérifications des inputs
    if(checkLogin($login))
    {
        if(checkPassword($password))
        {
            //Récupération des données de l'utilisateur
            $user = getUser($login,$password);
                
            // Si l'utilisateur existe on l'enregistre en session et on le connecte
            if($user)
            { 
                $_SESSION["user"] = $user;
                $message = "&message=".urlencode("Connexion réussie!");
                $connected = true;
            }
        }
    }
}

if($connected)
{
	//On redirige vers la page d'origine
	header("Location: ?".$_SESSION["origin_page"].$message);
}
else
{
    
    $error = "&error=".urlencode("Identifiant ou mot de passe incorrect");
    header("Location: ?page=login".$get_login.$error.$message);
}
?>