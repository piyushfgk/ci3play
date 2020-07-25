<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<title><?= $page->title; ?></title>
</head>
<body>
<div class="container pt-2">
	<ul class="nav nav-pills justify-content-end">
		<li class="nav-item">
			<a class="nav-link <?php echo $page->title == 'Home' ? 'active' : NULL; ?>" aria-current="page" href="<?= base_url() ?>">Home</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php echo $page->title == 'Posts' ? 'active' : NULL; ?>" href="<?= base_url() ?>pages/post">Posts</a>
		</li>
	</ul>
</div>