<?php require APPROOT . '/views/inc/header.php';?>
<div class="container">
<h1><?php echo $data['title'];  ?></h1>
<p class="lead"><?php echo $data['description'];?></p>
<h5>Version:<?php echo APPVERSION; ?></h5>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>