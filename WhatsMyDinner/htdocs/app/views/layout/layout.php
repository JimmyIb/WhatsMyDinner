<html>
	<?php require_once 'head.php' ?>
	<link rel="stylesheet"
           href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	<body>
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

		  <a class="navbar-brand" href="/post/dashboard"><img src='/app/images/chefhat.jpg'class='rounded-circle' style='background-color: white; width: 50px; height: 50px; float: right'/></a>
		  <?php 
		  	if(isset($_SESSION['isAdmin'])){
		  		print "<p style='color:white'>You are logged in as an admin</p>";
		  	}
		  ?>
		  <!-- Links -->
		  <ul class="navbar-nav ml-auto">
		  	<li class='nav-item'>
				<a class='nav-link' href='/post/dashboard'>Dashboard</a>
			</li>
		  	<?php
		  		if(isset($_SESSION['user_id'])){
		  			if(!isset($_SESSION['profile_id'])){
			  			print "
			  				<li class='nav-item'>
				     			<a class='nav-link' href='/profile/create'>Create Profile</a>
				   			</li>
			  			";
		  			}else{
						print "
							<li class='nav-item'>
				     			<a class='nav-link' href='/profile/index'>My Profile</a>
				   			</li>
				  			 <li class='nav-item'>
				     			<a class='nav-link' href='/savedpost/index'>My Saved Recipes</a>
				   			</li>";
		  			}
		  			print "<li class='nav-item'>
					     		<a class='nav-link' href='/home/logout'>Logout</a>
					   		</li>
				   		";

		  		}else{
		  			print"
		  			<li class='nav-item'>
			     		<a class='nav-link' href='/home/login'>Login</a>
			   		</li>";
		  		}
 	  	    ?>
			   <li class="nav-item">
			   		<?php require_once 'layoutSearch.php' ?>
			   </li>
		  </ul>
		</nav>
	</body>
</html>