<style>
html,
body {
  height: 100%;
}

body {
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

</style>

<div class="container mt-2">
  <?php echo validation_errors('<div class="alert alert-danger" role="alert">','</div>'); ?>
</div>

<?= form_open('pages/do_login', array("class" => "form-signin")) ?>
  <img class="mb-4" src="<?= base_url('img/brand_logo.png') ?>" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
  <input type="email" name="email" id="inputEmail" class="form-control  <?php echo !empty(form_error('email')) ? 'is-invalid' : NULL; ?>" placeholder="Email address" value="<?= set_value('email') ?>" autofocus>
  <label for="inputPassword" class="sr-only">Password</label>
  <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password"  value="<?= set_value('password') ?>">
  <div class="checkbox mb-3">
    <!-- <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label> -->
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <p class="text-center mt-2">Not registered ? <a href="<?= base_url('pages/registration') ?>">Sign up</a> </p>  
<?= form_close() ?>