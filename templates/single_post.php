<br>
<?php

if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {

    echo '<a href="?e=' . $article->getId() . '">EDIT</a>';
}

?>
<h1><?php echo $article->getTitle(); ?></h1>
<p><?php echo $article->getContent(); ?></p>
<?php if($article->getFileToUpload()) { ?>
    <img src="resources/images/<?php echo $article->getFileToUpload(); ?>" style="height: 400px;">
<?php } ?>
<br><br><br>