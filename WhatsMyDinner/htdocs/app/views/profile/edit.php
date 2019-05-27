<html>
  <head>
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
    <link href='/css/checkbox.css' rel='stylesheet'/>
    <form method='post' enctype="multipart/form-data" onsubmit='return validateForm()'>  
      <div class="container">
          <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
              <div class="card card-signin my-5">
                <div class="card-body">
                  <h5 class="card-title text-center"><b>Edit Profile</b></h5>
                      <div class="form-label-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" id='fNameInput' name='fname'placeholder="First Name" value="<?php echo $data->first_name ?>" autofocus>
                        <p id='errorFirstName'></p>
                      </div>

                      <div class="form-label-group">
                        <label>Last Name</label>
                        <input type="text" name='lname' class="form-control" id='lNameInput' placeholder="Last Name" value="<?php echo $data->last_name?>" >
                        <p id='errorLastName'></p>
                      </div>
                      <div class='form-label-group'>
                        <label for="picture" style="margin-right: 10px;">Change profile picture</label>
                        <input type="file" class="form-control-file" name="picture"/>
                      </div>
                      <br/>
                      <?php 
                      if($data->picture_id != 2){
                        print "
                          <div class='form-label-group'>
                            <div class='boxes'>
                              <input type='checkbox' id='box-1' name='removePic'>
                              <label for='box-1'>Remove Profile Picture</label>
                            </div>
                          </div>
                        ";
                      }
                      ?>
                        <button class="btn btn-lg btn-primary btn-block"name='editProfile' type="submit">Edit Profile</button>
                </div>
              </div>
            </div>
          </div>
        </div>
     </form>
     <script src='/js/createProfileValidation.js'></script>
  </body>
 </html>