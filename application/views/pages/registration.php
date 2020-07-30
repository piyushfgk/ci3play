<style>
    .divider-text {
        position: relative;
        text-align: center;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .divider-text span {
        padding: 7px;
        font-size: 12px;
        position: relative;   
        z-index: 2;
    }
    .divider-text:after {
        content: "";
        position: absolute;
        width: 100%;
        border-bottom: 1px solid #ddd;
        top: 55%;
        left: 0;
        z-index: 1;
    }
    
    #registration--form{
        width: 400px;
        margin: 0 auto;
    }
</style>

<div class="container">
    <?php //echo validation_errors('<div class="alert alert-danger" role="alert">','</div>'); ?>

    <?= form_open('pages/do_register', array("class" => "mt-5", "id" => "registration--form")) ?>
        <label for="name" class="text-secondary">Name</label>
        <div class="input-group mb-2">
            <span class="input-group-text"> <i class="fa fa-fw fa-user"></i> </span>
            <input id="name" name="name" class="form-control <?php echo !empty(form_error('name')) ? 'is-invalid' : NULL; ?>" placeholder="Full name" type="text" value="<?= set_value('name') ?>">
            <div id="nameHelp" class="<?php echo !empty(form_error('name')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('name') ?? NULL; ?></div>
        </div> <!-- form-group// -->

        <label for="email" class="text-secondary">Email</label>
        <div class="input-group mb-2">
            <span class="input-group-text"> <i class="fa fa-fw fa-envelope"></i> </span>
            <input id="email" name="email" class="form-control <?php echo !empty(form_error('email')) ? 'is-invalid' : NULL; ?>" placeholder="Email address" type="email" value="<?= set_value('email') ?>">
            <div id="emailHelp" class="<?php echo !empty(form_error('email')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('email') ?? NULL; ?></div>
        </div> <!-- form-group// -->

        <label for="password" class="text-secondary">Password</label>
        <div class="input-group mb-2">
            <span class="input-group-text"> <i class="fa fa-fw fa-lock"></i> </span>
            <input id="password" class="form-control <?php echo !empty(form_error('password')) ? 'is-invalid' : NULL; ?>" placeholder="Create password" name="password" type="password" value="<?= set_value('password') ?>" <?php echo !empty(form_error('password')) ? 'autofocus' : NULL; ?>>
            <div id="passwordHelp" class="<?php echo !empty(form_error('password')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('password') ?? NULL; ?></div>
        </div> <!-- form-group// -->

        <label for="confirm_password" class="text-secondary">Confirm Password</label>
        <div class="input-group mb-3">
            <span class="input-group-text"> <i class="fa fa-fw fa-lock"></i> </span>
            <input id="confirm_password" class="form-control <?php echo !empty(form_error('confirm_password')) ? 'is-invalid' : NULL; ?>" placeholder="Repeat password" name="confirm_password" type="password">
            <div id="confirm_passwordHelp" class="<?php echo !empty(form_error('confirm_password')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('confirm_password') ?? NULL; ?></div>
        </div> <!-- form-group// -->                                      
        
        <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
         
        <p class="text-center">Have an account? <a href="<?= base_url('pages/login') ?>">Log In</a> </p>                                                                 
    <?= form_close() ?>

</div>