<?php
$check = false;
$message = "";

//On vérifie que l'id_post est un entier positif
$options = ['options'=>['min_range'=>1]];
$id_topic = filter_var($_SESSION["my_get"]["topic"],FILTER_VALIDATE_INT,$options);

if($id_topic)
{
	//On vérifie que l'utilisateur a le droit de supprimer le post
	if( isLogged(ADMINISTRATOR) && isGranted($_SESSION["user"]["id_role"],CAN_DELETE_TOPIC) )
	{
        //On supprime les posts du topic
        if(deletePostsByTopic($id_topic))
		{
            //On supprime le topic
            if(deleteTopic($id_topic))
            {
                $message = "&message=".urlencode("Le Sujet a été supprimé avec succès.");
                $check = true;
            }
            else
            {
                $message = "&message=".urlencode("Une erreur est survenue lors de la suppresssion du sujet.");
            }
		}
		else
		{
			$message = "&message=".urlencode("Une erreur est survenue lors de la suppresssion du sujet.");
		}
	}
}

if($check)
{
    //Rediriger vers la page d'accueil
    header("Location: ?page=home".$message);
}
else
{
    //Rediriger vers la page précédente
    header("Location: ?".$_SESSION["origin_page"].$message);
}
?>