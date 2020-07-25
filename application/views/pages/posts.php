<div class="container">

    <?php if($page->title == 'Create Post'): ?>
    
    <?php //echo validation_errors(); ?>

    <form action="<?= base_url('posts/add') ?>" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control <?php echo !empty(form_error('title')) ? 'is-invalid' : NULL; ?>" id="title" name="title" value="<?php echo set_value('title'); ?>" aria-describedby="titleHelp">
            <div id="titleHelp" class="<?php echo !empty(form_error('title')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('title') ?? NULL; ?></div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="10" class="form-control <?php echo !empty(form_error('description')) ? 'is-invalid' : NULL; ?>"  aria-describedby="descriptionHelp"><?php echo set_value('description'); ?></textarea>
            <div id="descriptionHelp" class="<?php echo !empty(form_error('description')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('description') ?? NULL; ?></div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add Post</button>
    </form>
    <?php endif; ?>

    <?php if($page->title == 'Post Status'): ?>
        <div class="alert alert-<?= $db->status ?>" role="alert">
           <i class="fa fa-<?= $db->icon ?>"></i> <?= $db->message ?>
        </div>
    <?php endif; ?>
</div>