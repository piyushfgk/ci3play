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
		<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="<?= base_url() ?>">My Blog</a>
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
					<a class="btn btn-outline-info" href="#">Sign up</a>
				</div>
				
			</div>
		</nav>
	</header>