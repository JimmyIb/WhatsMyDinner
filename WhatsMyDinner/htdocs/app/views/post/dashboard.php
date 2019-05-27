<html>
<head>
	<title>What's My Dinner?</title>
	<link href='/css/cardPost.css' rel='stylesheet'/>
	<style>
		body{
			  background: url("/App/images/dashboardBackground.jpg");
			  min-height: 100%;
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-position: center;
				background-size: cover
		}
	</style>
</head>
<body>
	<div style="margin: 20px;">
		<?php 
			if(isset($_SESSION['user_id'])){
				print "<div style='margin: 10px;'><a href='/post/create' class='btn btn-primary float-right'>Add a Recipe</a></div>";
			}
		?>
		<h2 style='display: block'>What's My Dinner?</h2>
		
		<form id='sorting'style='margin-left: 5px;'>
			
			<div class='row'>
				<div class="dropdown">
					<div class="btn-group btn-group-toggle"  data-toggle="buttons">
						<?php 
							if(isset($_SESSION['profile_id'])){
								
								print "
									<input type='checkbox' id='follow' checked data-toggle='toggle' data-on='Following' name='follow' data-off='All Users' data-onstyle='success' data-offstyle='danger' data-style='quick'>
								";
									if(!isset($_GET['follow'])){
										print "
										<script>
											$('#follow').bootstrapToggle('off');
										</script>
										";
									}
							}
						?>
						
					</div>

					<div class="btn-group btn-group-toggle" data-toggle="buttons" style="background-color: white;">
						<?php
							foreach($data as $value){
								if(isset($_GET['type']) && $_GET['type'] == $value->description){
									print "
									<a class='btn btn-outline-secondary active'>
										<input type='radio' name='type' checked  class='typeSelect' value='$value->description'  autocomplete='off'> $value->description
									</a>";
								}else{
									if(!isset($_GET['type']) && $value->description == 'All'){
										print "
										<a class='btn btn-outline-secondary active'>
											<input type='radio' name='type' checked  class='typeSelect' value='$value->description'  autocomplete='off'> $value->description
										</a>
										";
									}else{
										print "
											<a class='btn btn-outline-secondary'>
												<input type='radio' name='type' class='typeSelect' value='$value->description' autocomplete='off'> $value->description
											</a>
										";
									}
								}
							}
						?>
					</div>
				</div>

				 <div class="form-group" style='margin-left: 5px'>
					<select class="form-control border-secondary" id='dropdown' name="sortby">
						<?php 
							$arrayOptions = array("Newest", "Oldest","Best","Worst");
							if(isset($_GET['sortby'])){
								foreach($arrayOptions as $value){
									if($_GET['sortby'] == $value){
										print "<option selected='selected' value='$value'>$value</option>";
									}else{
										print "<option value='$value'>$value</option>";
									}
								
								}
							}else{
								foreach($arrayOptions as $value){
									print "<option value='$value'>$value</option>";
								}
							}
						 ?>
					</select>
				</div> 
			</div>
		</form>
	</div>
	<script>
		$(document).ready(function(){
			function submitForm(){
				$("#sorting").submit();
			}

			$('#sorting input').on('change', function(e){
				submitForm();
			});

			$('#dropdown').on('change', function(){
				submitForm();
			});
		});
		
	</script>
</body>
</html>