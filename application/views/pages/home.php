<div class="container mt-5">

	<?php if($page->title == 'Posts'): ?>
		<a href="<?= base_url('posts/add') ?>" class="btn btn-info"><i class="fa fa-plus"></i> Create Post</a>
	<?php endif; ?>	

	<?php if($page->title == 'Home'): ?>
		<?php if(!empty($posts)): ?>
		<?php foreach($posts as $post): ?>
			<div class="card my-3">
				<div class="card-header">
					<div class="d-flex justfy-content-between align-items-center">
						<div class="h6 m-0"><?= $post->title ?></div>
						<div class="ml-auto">
							<a href="<?= base_url('posts/edit/'.$post->id) ?>" class=""><i class="fa fa-edit text-success"></i></a>
							<a href="<?= base_url('posts/delete/'.$post->id) ?>" class="ml-2"><i class="fa fa-trash text-danger"></i></a>
						</div>
					</div>
				</div>
				<div class="card-body">
					<p class="card-title text-right text-secondary"><strong>Added on:</strong> <?= indate($post->added_on) ?></p>
					<p class="card-text"><?= nl2br($post->description) ?></p>
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
	<?php endif; endif; ?>
</div>