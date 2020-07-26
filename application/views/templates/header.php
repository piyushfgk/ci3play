<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
	<title><?= $page->title; ?></title>
</head>
<body>
<!-- <div class="container-fluid"> -->
    <nav class="navbar navbar-expand-lg bg-light sticky-top px-3" >
	<ul class="nav nav-pills ml-auto">
		<li class="nav-item">
			<a class="nav-link <?php echo $page->title == 'Home' ? 'active' : NULL; ?>" aria-current="page" href="<?= base_url() ?>">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo $page->title == 'Posts' ? 'active' : NULL; ?>" href="<?= base_url() ?>pages/post">Posts</a>
		</li>
	</ul>
    </nav>
<!-- </div> -->