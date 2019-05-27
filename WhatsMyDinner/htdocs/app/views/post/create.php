<html>
	<head>
		<title>Create Post</title>
		<style>
			body{
				
		          /*background: url("/App/images/backgroundCreatePost.png");*/
		          background: url("/App/images/backgroundCreatePost2.jpg");
		          min-height: 100%;
		          background-repeat: no-repeat;
		          background-attachment: fixed;
		          background-position: center;
		          background-size: cover;    
			}
			form{
			}
		</style>
	</head>
	<body>
		<h2 style='margin: 10px'>Create Post</h2>
		<div class='d-flex container-fluid  justify-content-center form'>
			<!--onsubmit="return validateForm()" -->
			<form method="post" class="form-horizontal container-fluid" onsubmit="return validateForm()" enctype="multipart/form-data">
				<div style="margin: 20px;">
					<a href="/post/dashboard" class="btn btn-danger float-left">Go Back</a>
					<input class="btn btn-primary float-right" type="submit" value="Add Recipe" name="submit"/>
				</div>
				<br/>
				<p id='errorText'></p>
				<div class="control-group form-inline offset-3" style="padding: 20px;">
					<label class="control-label col-sm-1" for="title">Title</label>
					<textarea name="title" id='titleTextArea' class="form-control col-md-4"   rows='1' maxlength="100"></textarea>
				</div>

				<div class="row control-group col-md-12">
					<div class="col-lg-5">
						<label for="description" class="col-sm-1">Description</label>
						<textarea class="form-control"  rows="5" name="description"  id='descriptionTextArea' maxlength='150' placeholder="Enter a short description"></textarea>
					</div>

					<div class="col-lg-5">
						<label for="ingredients" class="col-sm-1">Ingredients</label>
						<textarea class="form-control"  rows="5" name="ingredients"  id='ingredientsTextArea' placeholder="Seperate each ingredient per line"></textarea>
					</div>
				</div>


				<div class="row control-group col-md-12">
					<div class="col-lg-5">
						<label for="direction" class="col-sm-1">Directions</label>
						<textarea class="form-control"  rows="5" name="directions"  placeholder="Seperate each directions by line" id='directionsTextArea'></textarea>
					</div>

					<div class="col-lg-5 form-horizontal" style='margin-left: 20px'>
						<div class="row">
							<div>
								<label for="time">Cooking Time (minutes)</label>
								<input type="number"  class="form-control col-sm-5" name="time" id='cookTimeInput'/>
								<p id='errorCookTime'></p>
								<label for="prepTime">Preperation Time (minutes)</label>
								<input type="number" class="form-control col-sm-5" name="prepTime" id='prepTimeInput'/>
								<p id='errorPrepTime'></p>
								<label for="portion">Portions</label>
								<input type="number" class="form-control col-sm-5" name="portions" id='portionsInput'/>
								<p id='errorPortions'></p>
							</div>

							<div>
								<div class="form-group">
									<label for="typeSelect">Type</label>
									<select  class="form-control" name="type"  id='typeInput'>
										<option value ="">Please select a type</option>
										<?php 
											foreach($data as $value){
												if($value->description != "All"){
													print "<option>" . $value->description . "</option>";
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