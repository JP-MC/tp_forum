<?php
$topic_created = false;
$message = "";

if(isset($_POST["topic_title"]) && isset($_POST["id_category"]) && isset ($_POST["post_content"]) && isset ($_POST["id_user"]))
{
    if(isLogged() && isGranted($_SESSION["user"]["id_role"],CAN_CREATE_TOPIC))
    {
        $topic_title = $_POST["topic_title"];
        $post_content = $_POST["post_content"];

        $options = ['options'=>['min_range'=>0]];
        $id_user = filter_var($_POST["id_user"],FILTER_VALIDATE_INT,$options);
       
        $date_creation = date("Y-m-d H:i:s");

        //Vérifications
        $check = false;
        if( checkTitle($topic_title) && checkId($id_category))
        {
            $check = true;
        }

        if($check)
        {
            // Return inserted_id or 0
            $id_topic = createTopic($topic_title,$date_creation,$id_user,$id_category);
            
            if($id_topic)
            {
                $message = "Le Sujet a bien été créé!";
                
                // Ajout du premier message
                if(createPost($id_topic,$id_user,$post_content,$date_creation))
                {
                    //TODO gérer le cas où le topic est créé mais pas le premier post
                    $message .= " - Une erreur est survenue lors de l'insertion du message.";
                }
                else
                {
                    $topic_created = true;
                }
            }
            else
            {
                $message = "Une erreur est survenue lors de l'insertion du topic.";
            }
        }
    }
}

$message = urlencode($message);

if($topic_created)
{
    //Rediriger vers la page du topic
    header("Location: ?page=topic&topic=".$id_topic."&message=".$message);
}
else
{
    //Rediriger vers la page précédente
    header("Location: ?".$_SESSION["origin_page"]."&message=".$message);
}
?>