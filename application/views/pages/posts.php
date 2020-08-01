<div class="container">

    <?php if($page->title == 'Create Post' || $page->title == 'Edit Post' || $page->title == 'Delete Post'): ?>

    <a href="<?= base_url() ?>" class="btn btn-sm btn-info mt-5"><svg stroke="white" stroke-width="2"  width="1em" height="1em" viewBox="0 2 16 16" class="bi bi-arrow-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path fill-rule="evenodd" d="M5.854 4.646a.5.5 0 0 1 0 .708L3.207 8l2.647 2.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 0 1 .708 0z"/>
  <path fill-rule="evenodd" d="M2.5 8a.5.5 0 0 1 .5-.5h10.5a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/></svg> Back</a>

    <?php // echo validation_errors('<div class="alert alert-danger mt-3" role="alert">','</div>'); ?>

    <?php if($page->title == 'Edit Post') echo form_open('posts/edit/'.set_value('id'), array("class" => "mt-3 needs-validation")); ?>
    <?php if($page->title == 'Delete Post') echo form_open('posts/delete/'.set_value('id'), array("class" => "mt-3 needs-validation")); ?>
    <?php if($page->title == 'Create Post') echo form_open('posts/add', array("class" => "mt-3 needs-validation")); ?>

        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control <?php echo !empty(form_error('title')) ? 'is-invalid' : NULL; ?>" id="title" name="title" value="<?php echo set_value('title'); ?>" aria-describedby="titleHelp" <?php if(!empty($inputs->readonly)) echo 'readonly'; ?>>
            <div id="titleHelp" class="<?php echo !empty(form_error('title')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('title') ?? NULL; ?></div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" <?php if(!empty($inputs->readonly)) echo 'readonly'; ?> rows="10" class="form-control <?php echo !empty(form_error('description')) ? 'is-invalid' : NULL; ?>"  aria-describedby="descriptionHelp"><?php echo set_value('description'); ?></textarea>
            <div id="descriptionHelp" class="<?php echo !empty(form_error('description')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('description') ?? NULL; ?></div>
        </div>

        <?php if($page->title == 'Edit Post'): ?>
            <div class="d-flex justify-content-between mb-3">
                <button type="submit" class="btn btn-success" name="action" value="save_post" ><i class="fa fa-save"></i> Save Post</button>
                <a href="<?= base_url() ?>" class="btn btn-secondary"><svg stroke="white" stroke-width="2"  width="1em" height="1em" viewBox="0 1 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>  <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/></svg> Cancel</a>
            </div>
        <?php endif; ?>
        <?php if($page->title == 'Delete Post'): ?>
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <button type="submit" class="btn btn-warning" name="action" value="delete"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/></svg> Delete</button>
                    <a href="<?= base_url() ?>" class="btn btn-secondary"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>  <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/></svg> Cancel</a>
                </div>
                <button type="submit" class="btn btn-danger btn-sm" name="action" value="hard_delete"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash2-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">  <path d="M2.037 3.225l1.684 10.104A2 2 0 0 0 5.694 15h4.612a2 2 0 0 0 1.973-1.671l1.684-10.104C13.627 4.224 11.085 5 8 5c-3.086 0-5.627-.776-5.963-1.775z"/>  <path fill-rule="evenodd" d="M12.9 3c-.18-.14-.497-.307-.974-.466C10.967 2.214 9.58 2 8 2s-2.968.215-3.926.534c-.477.16-.795.327-.975.466.18.14.498.307.975.466C5.032 3.786 6.42 4 8 4s2.967-.215 3.926-.534c.477-.16.795-.327.975-.466zM8 5c3.314 0 6-.895 6-2s-2.686-2-6-2-6 .895-6 2 2.686 2 6 2z"/></svg> Hard Delete</button>
            </div>
        <?php endif; ?>
        <?php if($page->title == 'Create Post'): ?>
            <button type="submit" name="action" value="create_post" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Add Post</button>
        <?php endif; ?>

    <?= form_close() ?>
    <?php endif; ?>

</div>