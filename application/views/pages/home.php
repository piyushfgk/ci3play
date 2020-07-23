<div class="container">
	<div class="card">
		<div class="card-header">
			<?= $page->title; ?>
		</div>
		<div class="card-body">
			<h5 class="card-title"><?= $heading; ?></h5>
			<p class="card-text"><?php echo $post ?? NULL; ?></p>
		</div>
	</div>
</div>