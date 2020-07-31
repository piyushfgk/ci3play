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
            <span class="input-group-text"> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
</svg> </span>
            <input id="name" name="name" class="form-control <?php echo !empty(form_error('name')) ? 'is-invalid' : NULL; ?>" placeholder="Full name" type="text" value="<?= set_value('name') ?>">
            <div id="nameHelp" class="<?php echo !empty(form_error('name')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('name') ?? NULL; ?></div>
        </div> <!-- form-group// -->

        <label for="email" class="text-secondary">Email</label>
        <div class="input-group mb-2">
            <span class="input-group-text"> 
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/> </svg> 
            </span>
            <input id="email" name="email" class="form-control <?php echo !empty(form_error('email')) ? 'is-invalid' : NULL; ?>" placeholder="Email address" type="email" value="<?= set_value('email') ?>">
            <div id="emailHelp" class="<?php echo !empty(form_error('email')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('email') ?? NULL; ?></div>
        </div> <!-- form-group// -->

        <label for="password" class="text-secondary">Password</label>
        <div class="input-group mb-2">
            <span class="input-group-text"> 
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/> <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/></svg> 
            </span>
            <input id="password" class="form-control <?php echo !empty(form_error('password')) ? 'is-invalid' : NULL; ?>" placeholder="Create password" name="password" type="password" value="<?= set_value('password') ?>" <?php echo !empty(form_error('password')) ? 'autofocus' : NULL; ?>>
            <div id="passwordHelp" class="<?php echo !empty(form_error('password')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('password') ?? NULL; ?></div>
        </div> <!-- form-group// -->

        <label for="confirm_password" class="text-secondary">Confirm Password</label>
        <div class="input-group mb-3">
            <span class="input-group-text"> 
                <svg width="1em" height="1.2em" viewBox="0 0 16 16" class="bi bi-lock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg"> <path d="M2.5 9a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2V9z"/> <path fill-rule="evenodd" d="M4.5 4a3.5 3.5 0 1 1 7 0v3h-1V4a2.5 2.5 0 0 0-5 0v3h-1V4z"/></svg> 
            </span>
            <input id="confirm_password" class="form-control <?php echo !empty(form_error('confirm_password')) ? 'is-invalid' : NULL; ?>" placeholder="Repeat password" name="confirm_password" type="password">
            <div id="confirm_passwordHelp" class="<?php echo !empty(form_error('confirm_password')) ? 'invalid' : 'valid'; ?>-feedback"><?php echo form_error('confirm_password') ?? NULL; ?></div>
        </div> <!-- form-group// -->                                      
        
        <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
         
        <p class="text-center">Have an account? <a href="<?= base_url('pages/login') ?>">Log In</a> </p>                                                                 
    <?= form_close() ?>

</div>