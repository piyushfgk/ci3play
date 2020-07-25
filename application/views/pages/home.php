<div class="container mt-5">
	<?php if($page->title == 'Posts'): ?>
		<a href="<?= base_url('posts') ?>" class="btn btn-info"><i class="fa fa-plus"></i> Create Post</a>
		<?php foreach($posts as $post): ?>
			<div class="card my-3">
				<div class="card-header">
					<div class="d-flex justfy-content-between">
						<?= $post->title ?>
						<div class="ml-auto">
							<a href="<?= base_url('posts/edit/'.$post->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
							<a href="<?= base_url('posts/delete/'.$post->id) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<h6 class="card-title text-right">Added on: <?= $post->added_on ?></h6>
					<p class="card-text"><?= $post->description ?></p>
				</div>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<div class="card">
			<div class="card-header">
				<?= $page->title; ?>
			</div>
			<div class="card-body">
				<h5 class="card-title"><?= $heading; ?></h5>
				<p class="card-text"></p>
			</div>
		</div>
	<?php endif; ?>
</div>