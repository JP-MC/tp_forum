<?php
$category_list = getCategoryList();
?>

    <section class="main-wrap">
        <h2>Home</h2>
        <?php echo $html_error; ?>
        <?php echo $html_message; ?>
        <p>Message home</p>
    </section>
    <section id="category-list" class="main-wrap">
        <h3>Catégories</h3>

        <table>
            <thead>
                <tr>
                    <th>Catégories</th>
                    <th>Nombre de sujets</th>
                    <th>Nombre de messages</th>
                    <th>Dernier message (date et auteur)</th>
                </tr>
            </thead>
            
<?php
foreach ($category_list as $category)
{
	//Nombre de sujets dans cette catégorie
    $id_topic_list = getIdTopicList($category["id"]);
    $nbr_topics = count($id_topic_list);
	
    //Nombre de messages dans cette catégorie
    $nbr_posts_in_category = 0;
    $last_post_list = [];
    foreach($id_topic_list as $id_topic)
    {
		$nbr_posts_in_category += getNbrPostsInTopic($id_topic);
		//Dernier post du topic
		$last_post_list[] = getLastPost($id_topic);
    }
    //Selection du post le plus récent de la catégorie
	$html_last_post = "";
    if(!empty($last_post_list))
	{
		//Tri du tableau par date du plus grand au plus petit
		usort($last_post_list, function($a, $b)
		{
			return $b["date_creation"] <=> $a["date_creation"];
		});
		$html_last_post = "Le ".$last_post_list[0]["date_creation"]." par ".htmlentities($last_post_list[0]["user_login"]);
	}
	
	//AFFICHAGE
    echo "<tr><td><a href=\"?page=topic_list&category=".$category["id"]."\">".htmlentities($category["label"])."</a></td><td>".$nbr_topics."</td><td>".$nbr_posts_in_category."</td><td>".$html_last_post."</td></tr>\n";
}
?>
            
        </table>
    </section>