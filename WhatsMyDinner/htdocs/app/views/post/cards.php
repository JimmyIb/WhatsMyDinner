<div id='allrecipes'>
	<div class='row justify-content-center recipeRow'>
		<?php 
			foreach ($data as $value) {
				if($value->avg == 0){
					$value->avg = 'No Rating';
				}else{
					$value->avg = round($value->avg,1). '/5';
				}

				$ingredients = explode(PHP_EOL, $value->ingredients);
				$ingredientsList = '';
				$deleteBtn = '';
				$count = 0;
				$maxStrLength = 70;
				$start = 0;
		       foreach($ingredients as $item){ //ingredients
		       		if(strlen($item) > $maxStrLength){
		       			$ingredientsList .= "<li>" . substr($item, $start, $maxStrLength) . "...</li>";
		       		}elseif($item != '')
						$ingredientsList .= "<li>$item</li>";
					if($count == 2){
						$ingredientsList .= "<li>...</li>";
						break;
					}
					$count++;
				}
				if(isset($_SESSION['user_id'])){
					if(isset($_SESSION['profile_id']) && $value->profile_id == $_SESSION['profile_id'] || isset($_SESSION['isAdmin'])){
						$deleteBtn = "<input type='submit' class='btn btn-danger float-right' value='Delete'/>";
					}
					
				}
				$numReviews = '';
				if($value->numReviews != 0){
					$numReviews = "<small class='text-muted'>Number of Reviews: ". $value->numReviews ."</small>";
				}
				$date = date_create_from_format("Y-m-d H:i:s",$value->date_posted);
				$formattedDate = date_format($date, "d F Y");

				print "
				<div class='card-group recipe' style='width: 600px; margin-left: 50px'>
					<div class='card' style='border-right: 1px solid #d9d9d9;'>
						<a href='/post/viewPost/". $value->post_id ."'><img id='recipeImage' class='card-img-top' src='". $value->path ."'></a>
						<div class='card-body'>
							<p class='card-text'>Author: <a href='/profile/index/".$value->profile_id ."'>". $value->name ."</a></p>
							Type: ". $value->typeDesc."
								<br/> Rating: ". $value->avg ."<br/>
								". $numReviews ."<br/>
						</div>
						<div class='footer'>
							<small class='text-muted float-right' style='margin-right: 10px;'>Date posted: ". $formattedDate ."</small>
						</div>
					</div>

					<div class='card'>
						<div class='card-body'>
							<form onsubmit='return validateForm()' action='/post/delete/". $value->post_id ."' method='post'>
							". $deleteBtn ."
							</form>
							<h5 class='card-title' id='recipeTitle'>". $value->title ."</h5>
							<p class='card-text'> 
								". $value->description ."<br/><br/>
								Ingredients: <br/>
								<ul id='listIngredients'>
									". $ingredientsList ."
								</ul>
								<br/>Cook Time: ". $value->time ."
								<br/>Prep Time: ". $value->preperation_time ."
								<br/>Portions: ". $value->portions ." servings
							</p>
						</div>
						<div class='footer'>
							<div class='float-right'>
								<a class='btn btn-info' href='/post/viewPost/" . $value->post_id ."'>View</a>
							</div>
						</div>
					</div>
				</div>


				";
			}
			if($data == null){
				print "There are no posts :(";
			}else{
				print "</div><br/>	
				<p style='text-align: center'
				><b>End of Content</b></p>"; //close row div & add text end of content
			}
		?>

	</div>
	<script src='/js/viewPostValidation.js'></script>
