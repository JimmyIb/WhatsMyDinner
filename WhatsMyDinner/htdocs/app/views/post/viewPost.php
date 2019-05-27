<html>
<body>
<link href='/css/viewPost.css' rel='stylesheet'/>
<?php 
  $date = date_create_from_format("Y-m-d H:i:s",$data->date_posted);
  $formattedDate = date_format($date, "d F Y");
?>
  	<div class='row offset-1'>
          	<div class='card' style='width: 18rem;'>
          		<img class='card-img-top' src="<?php echo $data->path ?>"/>
          		<div class='card-body'>
          			<h4 class='card-title'><?php echo $data->title?></h4>
          			<p class='card-text'> 
          				Author: <a href="/profile/index/<?php echo $data->profile_id ?>"><?php echo $data->name ?></a><br/>
          				<small class='text-muted'>Date Posted: <?php echo $formattedDate?></small>
          			</p>
					<ul class='list-group list-group-flush'>
	          			<li class='list-group-item'>Cook Time: <?php echo $data->time ?></li>
	          			<li class='list-group-item'>Prep Time: <?php echo $data->preperation_time ?></li>
	          			<li class='list-group-item'>Portions: <?php echo $data->portions ?></li>
	          			<li class='list-group-item'>Type: <?php echo $data->descriptionType ?></li>
	          			<li class='list-group-item'>Rating: 
	          				<?php 
	          					if($data->avgRating == null){
	          						echo "No rating";
	          					}else{
	          						echo round($data->avgRating,1) . '/5';
	          					}

	          				?><br/>
                    <?php 
                      if($data->numReviews != 0){
                        print "<small class='text-muted'>Number of ratings:  $data->numReviews</small>";
                      }
                    ?>
                    
	          			</li>
	          		</ul>
          		</div>
          	</div>
         	
            <div class='col-lg-8' id='information'>
            
          		<div class='col-lg-11 bg-light border'>
            		<p>
            			<?php 
                   $deleteBtn = '';
                   $editBtn = '';
	            			if(isset($_SESSION['profile_id']) && $data->profile_id == $_SESSION['profile_id'] ||isset($_SESSION['isAdmin']) ){
	            				$deleteBtn = "<input type='submit' class='btn btn-danger float-right' value='Delete Recipe'/>";

	            			} 
	            			if(isset($_SESSION['profile_id']) && $data->profile_id == $_SESSION['profile_id']){
	            				$editBtn =  "<a href='/post/edit/" . $data->post_id ."' class='btn btn-warning float-right'>Edit Recipe</a>";
	            			}

                  if(isset($_SESSION['profile_id'])){
            				if($data->isSaved != null){
            					$link =  "'/savedPost/deleteSavedPost/" . $data->post_id . "'";
                      $btn = "<input type='submit' name= 'remove' value='Unsave Recipe' class='btn btn-danger float-right'/>";

            				}else{
								      $link =  "'/savedPost/addSavePost/" . $data->post_id . "'";
                      $btn = "<input type='submit' name='add' class='btn btn-primary float-right'value='Save Recipe' />";
            				}
                    print "
                      <form method='post' onsubmit='return validateForm()'action='/post/delete/" . $data->post_id . "'>
                        $deleteBtn
                      </form>
                      <form method='post' enctype='multipart/form-data' autocomplete='off'>
                        $editBtn
                        $btn
                      </form>

                    ";
                  }
            			?>
            		
             			<h3>Description</h3><hr><br/>
                 		 <?php echo $data->description ?>
               		</p>
           		</div>
           	
           		<div class='col-lg-11 bg-light border ingredients'>
            		<p>
                 	 	<h3>Ingredients</h3><hr><br/>
                 	 	<ul>
	                  		<?php 
	                  			$ingredientsArray = explode(PHP_EOL, $data->ingredients);
	                  			foreach($ingredientsArray as $value){ //add the values to $ingredientsData as HTML data
								          	if($value != '')
									              print "<li>$value</li><br/>";
								          }
	                  		?>
                  		</ul>
               	    </p>
            	</div>

           		<div class='col-lg-11 bg-light border'>
            		<p>
                  		<h3>Directions</h3><hr><br/>
                    	<ol>
                    		<?php 
	                  			$directionsArray = explode(PHP_EOL, $data->directions);
	                  			foreach($directionsArray as $value){
      									if($value != '')
      										print "<li>$value</li><br/>";
      								  }
	                  		?>
                    	</ol>
               		</p>
            	</div>
            </div>
        </div>
        <script src='/js/viewPostValidation.js'></script>
  <body>
<html>