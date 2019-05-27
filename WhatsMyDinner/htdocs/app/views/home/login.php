<html>
	<head>
		<title>Login</title>
   		<link href='/css/loginCss.css' rel='stylesheet'/>
	</head>

	<body>
		<div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Sign In</h5>
              <form method='post' onsubmit='return formValidation()'>
                  <div class="form-label-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name='username'placeholder="Username" id='usernameInput' autofocus>
                    <p id='errorUsername'></p>
                  </div>

                  <div class="form-label-group">
                    <label>Password</label>
                    <input type="password" name='password' class="form-control" id='passwordInput' placeholder="Password" >
                    <p id='errorPassword'></p>
                  </div>
                  <?php 
                    if(strrpos(strtolower($_GET['url']), 'invalid')){
                      print"<p style='color: red'>Invalid username or password</p>";
                    }
                  ?>
                  </br>
                  <button class="btn btn-lg btn-primary btn-block text-uppercase" value='login' name='submit' type="submit">Sign in</button>
              </form>
              <a href="/home/create">Click here to create a new account!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src='/js/loginValidation.js'></script>
	</body>
</html>