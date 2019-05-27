<html>
	<head>
		<link href='/css/cardPost.css' rel='stylesheet'/>
		<title>Search</title>
	</head>

	<body>
		<?php 
			if(isset($_GET['searchProfile'])){
				$search = "profile";
			}else{
				$search = "recipe";
			}

		?>
		<h2 style='margin:5px'>Search <?php echo $search ?> results for: <?php echo htmlEntities($_GET['search'], ENT_QUOTES) ?></h2>
		<form method='get' style='margin: 5px;'>
			<input type="hidden" name="search" value="<?php echo $_GET['search'] ?>">
			<?php 
				$isActive = '';
				$isActiveProfile = '';
				if(isset($_GET['searchProfile'])){
					$isActiveProfile = 'active';
				}else{
					$isActive = 'active';
				}
			?>
			<input type='submit' class='btn btn-outline-success <?php echo $isActiveProfile; ?>' value='Search Profiles' name='searchProfile'>
			<input type='submit' class='btn btn-outline-success <?php echo $isActive; ?>' value='Search Recipes'>
		</form>
	</body>
</html>