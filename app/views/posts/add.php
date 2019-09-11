<?php require APPROOT . '/views/inc/header.php';?>
<div class="container">
	<div class="row">
		<div class="col-lg-6 mx-auto">
			<a href="<?php echo URLROOT;?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
			<div class="card card-body bg-light mt-5">
				<h2>Add a Post</h2>
				<p>Create a post with this form</p>
				<form action="<?php echo URLROOT;?>/posts/add" method="post">
					<div class="form-group">
						<label for="title">Title: <sup>*</sup></label>
						<input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
						<span class="invalid-feedback"><?php echo $data['title_error'];?></span>
					</div>
					<div class="form-group">
						<label for="postBody">Post Body: <sup>*</sup></label>
						<textarea  name="body" class="form-control form-control-lg <?php echo (!empty($data['body_error'])) ? 'is-invalid' : ''; ?>" rows="6" cols="5"> <?php echo $data['body']; ?>
						</textarea>
						<span class="invalid-feedback"><?php echo $data['body_error'];?></span>
					</div>
						<input type="submit" name="sub" value="Send a Post" class="btn btn-success btn-block">
					
				</form>
			</div>
		</div>
	</div>
</div>
<?php require APPROOT . '/views/inc/footer.php';?>