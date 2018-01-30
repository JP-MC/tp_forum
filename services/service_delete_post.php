<?php
$error = "";
$message = "";

$id_post = checkId($_SESSION["my_get"]["post"]);

if($id_post)
{
	//TODO interdire la suppression du premier post
	
	//On récupère l'id_user du post (ou null)
	$post_id_user = getPostOwnerID($id_post);

	if($post_id_user)
	{
		//On vérifie que l'utilisateur a le droit de supprimer le post
		if( (isLogged() && isGranted($_SESSION["user"]["id_role"],CAN_DELETE_POST))  || (isLogged() && $post_id_user == $_SESSION["user"]["id_user"] && isGranted($_SESSION["user"]["id_role"],CAN_DELETE_OWN_POST)) )
		{
			//On supprime le post
			if(deletePost($id_post))
			{
				$message = "&message=".urlencode("Le message a été supprimé avec succès.");
			}
			else
			{
				$error = "&error=".urlencode("Une erreur est survenue lors de la suppresssion du message.");
			}
		}
		else
		{
			$error = "&error=".urlencode("Vous n'avez pas les permissions nécéssaires.");
		}
	}
}

//Rediriger vers la page précédente
header("Location: ?".$_SESSION["origin_page"].$error.$message);
?>