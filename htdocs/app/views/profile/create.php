<!DOCTYPE html>
<html>
<head>
	<title>Create Profile</title>
  <link href='/css/checkBox.css' rel='stylesheet'/>
  <style>
    body{
          background: url("/App/images/createProfileBackground.jpg");
          min-height: 100%;
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-position: center;
          background-size: cover
      }
  </style>
</head>
<body>
	<div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Create Profile</h5>
              <form method='post' onsubmit='return validateForm()'>
                  <div class="form-label-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" id='fNameInput'name='fname'placeholder="First Name"  autofocus>
                    <p id='errorFirstName'></p>
                  </div>

                  <div class="form-label-group">
                    <label>Last Name</label>
                    <input type="text" name='lname' id='lNameInput' class="form-control" placeholder="Last Name" >
                    <p id='errorLastName'></p>
                  </div>
                  </br>
                  <button class="btn btn-lg btn-primary btn-block" value='login' name='submit' type="submit">Create Profile</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src='/js/createProfileValidation.js'></script>
</body>
</html>