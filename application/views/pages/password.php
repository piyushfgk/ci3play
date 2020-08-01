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

    #password--form {
        width: 400px;
        margin: 0 auto;
    }
</style>

<div class="container">

    <?= form_open(base_url('password'), array("class" => "mt-5", "id" => "password--form")) ?>

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

        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-lock"></i> Change Password  </button>

    <?= form_close() ?>

</div>