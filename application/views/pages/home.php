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

<div class="container mt-5">
	<div class="card">
		<div class="card-header">
			<?= $page->title; ?>
		</div>
		<div class="card-body">
			<h5 class="card-title"><?= $heading; ?></h5>
			<p class="card-text"><?php echo $post ?? NULL; ?></p>
		</div>
	</div>

	<?php if($page->title == 'Posts'): ?>
	<nav aria-label="...">
		<?= $this->pagination->create_links() ?>
	</nav>
	<?php endif; ?>
</div>