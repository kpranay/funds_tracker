<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Signin Template for Bootstrap</title>
<link href="<?php base_url() ?>css_js/css_frameworks/css/bootstrap.min.css" rel="stylesheet">  

    <!-- Custom styles for this template -->
    <link href="<?php base_url() ?>css_js/css_custom/signin.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">
      <?php 
      $attributes = array('class'=>'form-signin');
      echo form_open('welcome', $attributes); ?>
      <form class="">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="user_name" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <?php echo form_close() ?>

    </div> <!-- /container -->
  </body>
</html>

