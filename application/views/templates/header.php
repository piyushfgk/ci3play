<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
	<title><?= $page->title; ?></title>
</head>
<body class="d-flex flex-column h-100">

	<header>
		<!-- Fixed navbar -->
		<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?= base_url() ?>"><img class="" src="<?= base_url('img/brand_logo.png') ?>" alt="" width="32" height="32"> My Blog</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav mr-auto mb-2 mb-md-0">
						<li class="nav-item">
							<a class="nav-link <?php echo $page->title == 'Home' ? 'active' : NULL; ?>" aria-current="page" href="<?= base_url() ?>">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link <?php echo $page->title == 'Posts' || $page->title == 'Create Post' || $page->title == 'Edit Post' || $page->title == 'Delete Post' ? 'active' : NULL; ?>" href="<?= base_url() ?>post">Posts</a>
						</li>
					</ul>
					<?php if($this->session->userdata('user_id')): ?>
						<ul class="ml-auto mb-2 mb-md-0">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle text-info" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
									<i class="fa fa-user"></i> <?= $this->session->userdata('user_name') ?>
								</a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
								</ul>
							</li>
						</ul>
					<?php else: ?>
						<a class="btn btn-outline-info" href="<?= base_url('pages/registration') ?>">Sign up</a>
					<?php endif;?>
				</div>
				
			</div>
		</nav>
	</header>

	<?php if($this->session->flashdata('db_status')): ?>
		<div class="div container mt-3">
			<div class="mt-3 alert alert-<?= $this->session->flashdata('db_status')->status ?> alert-dismissible fade show" role="alert">
				<i class="fa fa-<?= $this->session->flashdata('db_status')->icon ?>"></i> <?= $this->session->flashdata('db_status')->message ?>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
	<?php endif; ?>