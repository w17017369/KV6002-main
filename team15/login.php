<?php
  include 'functions.php';
  include 'header.php';

  //If referer exists then
  if ( isset( $_SERVER[ 'HTTP_REFERER' ] ) ) {
    //Store in variable
    $referer = $_SERVER[ 'HTTP_REFERER' ];
  } else {
    //If not then store index.php
    $referer = "index.php";
  }
?>

    <!-- Title header for login -->
    <div class="limiter">
		  <div class="container-login100">
			  <div class="wrap-login100">
				  <div class="login100-form-title">
					  <span class="login100-form-title-1">SIGN IN</span>
				  </div>
          <!-- Login form starts -->
				  <form class="login100-form validate-form" action="loginProcess.php" method="post">
            <div class="wrap-input100 validate-input m-b-26">
              <input type="hidden" name="referer" value="<?= $referer?>"/> 
              <label class="label-input100" for="username"></label>  
              <input type="text" class="input100" id="username" size="30" tabindex="1" placeholder="Username" accesskey="u" name="username" pattern="^[A-Za-z0-9_]{1,15}$" size="20" maxlength="20" required>         
            </div>
            <div class="wrap-input100 validate-input m-b-18">
              <label class="label-input100" for="password"></label>
              <input type="password" class="input100" id="password" size="50" tabindex="2" placeholder="Password (8 characters minimum)" accesskey="p" name="password" minlength="8" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" autocomplete="current-password" required>
            </div>
					  <div class="flex-sb-m w-full p-b-30">
						  <div class="contact100-form-checkbox">
							  <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							  <label class="label-checkbox100" for="ckb1">Remember me</label>
						  </div>
					  <div class="container-login100-form-btn">
              <button type="submit" value="Log In"  name="submit" class="login100-form-btn" id="submit" tabindex="3" accesskey="s">Login</button>						
					  </div>
            <div class="d-flex justify-content-center links"> Don't have an account? <a href="registration.php" class="ml-2">Sign Up</a> </div>
				  </form>
          <!-- Form ends -->
			  </div>
		  </div> 
	  </div>
    <!-- main ends -->

<?php
  include 'footer.php';
?>