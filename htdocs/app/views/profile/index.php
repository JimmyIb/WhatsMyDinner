<html>
	<head>
		<title><?php echo "WMD - " . $data[0]->name ?></title>
    
        <link href='/css/cardPost.css' rel='stylesheet'/>
        <link href='/css/profileIndex.css' rel='stylesheet'/>
	</head>

	<body>
		<div class='card-group profileCard sticky-top' id='fullCard' style='width: 250px; top: 20px; box-shadow: 0 10px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);;'>
    		<div class='card' id="myCard">
    			<div class='card-body'>
    				<div class='row'>
    				    <div id='profile'>
    				        <h5 style="text-align: center"><?php echo $data[0]->name?></h5>
    				        <img src='<?php echo $data[0]->path ?>'/>
    				        <?php 
    				        	if($data[0]->avg == 0){
    				        		$data[0]->avg = "No rating";
    				        	}else{
    				        		$data[0]->avg .= "/5";
    				        	}
    				        ?>
    				        <br/>Avg rating: <?php echo $data[0]->avg ?>
    				    </div>
    				    <div class='profileBtns'>
    				    	<?php 
                                //logged in user checks own profile
    				    		if(isset($_SESSION['profile_id']) && $_SESSION['profile_id'] == $data[0]->profile_id){
    				    			print "
                                     <a href='/profile/edit/" . $data[0]->profile_id ."' class='btn btn-warning'>Edit Profile</a><br/>
                                        <a href='/relation/index/" . $data[0]->profile_id . "' class='btn btn-secondary'>View Following (". $data[1]->numFollowing .")</a><br/>
                                        
    				    			";
    				    		}elseif(isset($_SESSION['profile_id'])){
    				    			
    				    				if(isset($data[0]->following)){
											$relationLink = '/relation/removeRelation/'. $data[0]->profile_id . "/" . $_GET['url'];
											$btn = "<button type='submit' class='btn btn-danger'>Unfollow</button><br/>";
    				    				}else{
    				    					$relationLink = '/relation/addRelation/'. $data[0]->profile_id . "/" . $_GET['url'];
    				    					$btn = "<button type='submit' class='btn btn-primary'>Follow</button><br/>";
    				    				}
    				    				print "
											<form method='post' action='$relationLink'>
	    				               			$btn
	    				               		</form>
	    				    			";
    				    			
    				    		}
                                if($data[0]->numFollowers == null){
                                    $numFollowers = 0;
                                }else{
                                    $numFollowers = $data[0]->numFollowers;
                                }
                                print "<a href='/review/index/" . $data[0]->profile_id ."'   class='btn btn-success'>View Reviews (" . $data[2]->numReviews .") </a>
                                <a href='/relation/followers/" . $data[0]->profile_id ."'   class='btn btn-info'>View Followers (". $numFollowers . ")</a>";

                                 if(isset($_SESSION['profile_id']) && ($_SESSION['profile_id'] == $data[0]->profile_id || isset($_SESSION['isAdmin']))){
                                    print
                                   " <form method='post'style='margin:10px;' action='/profile/delete/ " . $data[0]->profile_id . "'>
                                        <input type='submit' class='btn btn-danger float-right'value='Delete Account'/>
                                    </form>";
                                }
    				    	?>  
    				     </div>      
    				 </div>
    			</div>
    		</div>
    	</div>
         <script src="/js/profileJS.js"></script>
	</body>
</html>