<nav id="myNav" class="navbar navbar-expand-lg navbar-dark bg-dark mb-3" role="navigation">
	<div class="container">
			<a href="<?php echo URLROOT; ?>" class="navbar-brand"><?php= SITENAME; ?></a>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbardefault" aria-controls="#navbardefault"aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			
	<div class="navbar-collapse collapse" id="navbardefault">
		<ul class="navbar-nav mr-auto">
			<li role="presentation" class="nav-item"><a class="nav-link" href="<?php echo URLROOT; ?>">HOME</a></li>
			<li role="presentation" class="nav-item"><a class="nav-link" href="<?php echo URLROOT;?>/pages/about">About Us</a></li>
		</ul>
		<ul class="navbar-nav ml-auto">
			<?php if(isset($_SESSION['user_id'])) {?>
				<li role="presentation" class="nav-item"><a class="nav-link" href="#">Welcome <?php echo $_SESSION['user_name'];?></a></li>
				<li role="presentation" class="nav-item"><a class="nav-link" href="<?php echo URLROOT;?>/users/logout">Logout</a></li>
			<?php } else {?>
			<li role="presentation" class="nav-item"><a class="nav-link" href="<?php echo URLROOT;?>/users/register">Register</a></li>
			<li role="presentation" class="nav-item"><a class="nav-link" href="<?php echo URLROOT;?>/users/login">Login</a></li>
		<?php }?>
		</ul>
	</div>
	</div>
</nav>