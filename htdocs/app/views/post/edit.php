<html>
	<head>
		<title>Edit Post</title>
		<style>
			body{
		         /* background: url("/App/images/backgroundCreatePost.png");*/
		          background: url("/App/images/backgroundCreatePost2.jpg");
		          min-height: 100%;
		          background-repeat: no-repeat;
		          background-attachment: fixed;
		          background-position: center;
		          background-size: cover
			}
		</style>
	</head>
	<body>
		<h2 style='margin: 10px;'>Edit Recipe</h2>
		<div class='d-flex justify-content-center'>
		<form method="post" style='margin: 10px;'>
			<input type='submit'name='cancel' value='Cancel' class="btn btn-danger float-left"/>
		</form>
		<form method="post" class="form-horizontal container-fluid" onsubmit="return validateForm()" enctype="multipart/form-data">
				<div style="margin: 20px;">
					<input class="btn btn-success float-right" type="submit" value="Update Recipe" name="submit"/>
				</div>
				<br/>
				<p id='errorText'></p>
				<div class="control-group form-inline offset-3" style="padding: 20px;">
					<label class="control-label col-sm-1" for="title">Title</label>
					<input type="text" name="title" id='titleTextArea' class="form-control col-md-4" value="<?php echo $data[0]->title; ?>" />
				</div>

				<div class="row control-group col-md-12">
					<div class="col-lg-5" style="margin-right: 40px;">
						<label for="description" class="col-sm-1">Description</label>
						<textarea class="form-control" id='descriptionTextArea' rows="5" name="description" placeholder="Enter description"><?php echo trim($data[0]->description); ?></textarea>
					</div>

					<div class="col-lg-4">
						<label for="ingredients" class="col-sm-1">Ingredients</label>
						<textarea class="form-control"  id='ingredientsTextArea' rows="5"  name="ingredients" placeholder="Seperate each ingredient per line"><?php echo $data[0]->ingredients; ?></textarea>
					</div>
				</div>


				<div class="row control-group col-md-12" style="margin-top: 40px;">
					<div class="col-lg-5" style="margin-right: 40px;">
						<label for="direction" class="col-sm-1">Directions</label>
						<textarea class="form-control" id='directionsTextArea' rows="5" name="directions" placeholder="Seperate each directions by line"><?php echo $data[0]->directions; ?></textarea>
					</div>

					<div class="col-lg-5 form-horizontal">
						<div class="row">
							<div>
								<?php 
									if(strpos($data[0]->time, 'minutes')){
										$cookTime = explode('minutes', $data[0]->time);
										$min = (int) $cookTime[0];
									}else{
										$cookTime = explode('h', $data[0]->time);
										$min = $cookTime[0] * 60 + $cookTime[1];
									}
								?>
								<label for="time" style="margin-right: 10px;">Cooking Time (minutes)</label>
								<input type="number" id='cookTimeInput' class="form-control col-sm-5" value="<?php echo $min; ?>" name="time"/>
								<p id="errorCookTime"></p>
								<label for="prepTime" style="margin-right: 10px;">Preperation Time (minutes)</label>
								<?php 
									if(strpos($data[0]->preperation_time, 'minutes')){
										$prepTime = explode('minutes', $data[0]->preperation_time);
										$min = (int) $prepTime[0];
									}else{
										$prepTime = explode('h', $data[0]->preperation_time);
										$min = (int) $prepTime[0] * 60 + (int) $prepTime[1];
									}
								?>

								<input type="number" id='prepTimeInput' class="form-control col-sm-5" value="<?php echo $min; ?>"name="prepTime"/>
								<p id="errorPrepTime"></p>
								<label for="portion" style="margin-right: 10px;">Portions</label>
								<input type="number"  id='portionsInput'class="form-control col-sm-5" value="<?php echo $data[0]->portions; ?>" name="portions"/>
								<p id="errorPortions"></p>
							</div>

							<div>
								<div class="form-group">
									<label for="typeSelect">Type</label>
									<select class="form-control" id='typeInput'  name="type">
										
										<?php 
											print "<option value='" . $data[2]->description . "'>". $data[2]->description . "</option>";
											foreach ($data[1] as $value) {
												$description = $value->description;
												if($description != "All" && $description !=$data[2]->description ){
													print "<option value='" . $description . "'>". $description . "</option>";
												}		
											}	
										?> 
									</select>	
								</div>
								<div>
									<label for="picture" style="margin-right: 10px;">Picture (Optional)</label>
									<input type="file" class="form-control-file" name="picture"/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<script src='/js/createPostValidation.js'></script>
	</body>
</html>