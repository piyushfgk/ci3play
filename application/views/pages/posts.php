<div class="container">

    <?php if($page->title == 'Create Post' || $page->title == 'Edit Post' || $page->title == 'Delete Post'): ?>
    
    <?php //echo validation_errors(); ?>

    <?php if($page->title == 'Edit Post'): ?> <form action="<?= base_url('posts/edit/'.set_value('id')) ?>" method="post"> <?php endif; ?>
    <?php if($page->title == 'Delete Post'): ?> <form action="<?= base_url('posts/delete/'.set_value('id')) ?>" method="post"> <?php endif; ?>
    <?php if($page->title == 'Create Post'): ?> <form action="<?= base_url('posts/add') ?>" method="post"> <?php endif; ?>
    
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
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success" name="action" value="save_post" ><i class="fa fa-save"></i> Save Post</button>
                <a href="<?= base_url('pages/post') ?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a> 
            </div>
        <?php endif; ?>
        <?php if($page->title == 'Delete Post'): ?> 
            <div class="d-flex justify-content-between">
                <div>
                    <button type="submit" class="btn btn-warning" name="action" value="delete"><i class="fa fa-trash"></i> Delete</button>
                    <a href="<?= base_url('pages/post') ?>" class="btn btn-secondary"><i class="fa fa-times"></i> Cancel</a>
                </div>
                <button type="submit" class="btn btn-danger" name="action" value="hard_delete"><i class="fa fa-recycle"></i> Hard Delete</button>
            </div>
        <?php endif; ?>
        <?php if($page->title == 'Create Post'): ?> <button type="submit" name="action" value="create_post" class="btn btn-primary"><i class="fa fa-plus"></i> Add Post</button> <?php endif; ?>
    </form>
    <?php endif; ?>

</div>