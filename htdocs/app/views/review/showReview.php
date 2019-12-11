<div class='col-sm-9 offset-1 border bg-light' style='border-radius: 20px'>
    <h3 style='margin: 5px;'>Reviews</h3> <hr/>
    <?php
    	if($data == null){
    		print "<p class='text-muted' style='text-align: center'>There are no reviews!<br/>Be the first to review this post</p>";
    	}else{
	    	foreach($data as $item){
	    		if(isset($_SESSION['profile_id']) && ($item->profile_id == $_SESSION['profile_id'] || isset($_SESSION['isAdmin']))){
	    			$deleteBtn = "<a href='/review/deleteReview/" . $item->review_id ."/" . $item->post_id ."' class='btn btn-danger float-right'>Delete Review</a>";
	    		}else{
	    			$deleteBtn = '';
	    		}

	    		print "
	    			<div class='card-w-50'>
						<div class='card-body'>
				    		<h5 class='card-title'>
				       		". $deleteBtn ."
				       		<a href='/profile/index/" .$item->profile_id ."'>  <img class='card-title' style='height: 50px; width: 50px' src='". $item->path ."'/></a>
				       		<a href='/profile/index/". $item->profile_id ."'>". $item->name ."</br></a>
				       		</h5>
				            <p class='card-text'>
				               ". $item->review_content . "
				            </p>
				      	 <small class='text-muted'>". $item->name ." rated this recipe ". $item->rating ."/5</small>
						</div>
					</div>
					<hr/>
	    		";
	    	}
    	}
    ?>
<hr/>