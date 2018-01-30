<?php
//récupérer la liste des catégories
$category_list = getCategoryList();

//Construction du menu
$html_category_menu = "";
foreach ($category_list as $category)
{
    $html_category_menu .= "<li><a href=\"?page=topic_list&category=".$category["id"]."\">".htmlentities($category["label"])."</a></li>";
}

//AFFICHAGE
?>

<nav id="category-menu" class="main-wrap">
    <ul>
        <?php echo $html_category_menu; ?>
    </ul>
</nav>