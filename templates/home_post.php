<br>
<?php
if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {

    echo '<a href="?e=' . $artical->getId() . '">EDIT</a>';
}
?>
<a href="?p=<?php echo $artical->getId(); ?>"><h1><?php echo $artical->getTitle(); ?></h1></a>
<p><?php echo $artical->getSummary(); ?></p>
<?php if($artical->getFileToUpload()) { ?>
<img src="resources/images/<?php echo $artical->getFileToUpload(); ?>" style="height: 50px;">
<?php } ?>
<br><br><br>