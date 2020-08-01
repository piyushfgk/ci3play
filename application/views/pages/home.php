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
                            <a href="<?= base_url('posts/edit/'.$post->id) ?>" class="" data-toggle="tooltip"  title="Edit"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square text-success" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg><span class="sr-only">Edit</span></a>
                            <a href="<?= base_url('posts/delete/'.$post->id) ?>" class="ml-2" data-toggle="tooltip"  title="Delete"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/></svg><span class="sr-only">Delete</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-title text-right text-secondary"><strong>Added on:</strong> <?= indate($post->added_on) ?> <span class="badge bg-primary"><?= $post->name ?></span>  </p>
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