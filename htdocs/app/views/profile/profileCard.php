<link href='/css/checkbox.css' rel='stylesheet'/>
<?php 
	if($data == null){
		print "<p class='text-center'> 
					There are no profiles !
				</p>
			   ";
	}else{
		print "<div class='row'>";
		$url = $_GET['url'];
		$key = 'search';
		$key2 = 'followers';
		$removeRelationBtn = '';
		foreach($data as $item){
			if($item->avg == 0){
				$item->avg = "No Rating";
			}else{
				$item->avg .= '/5';
			}
			if(strpos($url,$key) == false && strpos($url,$key2) == false ){
				$removeRelationBtn = "<input type='submit' value='Unfollow' class='btn btn-danger'/>";
			}
				print "
					<div class='card-group' style='width: 400px; margin: 40px'>
					    <div class='card'>
						        	<div class='card-body'>
						    <a href='/profile/index/". $item->profile_id ."'><img src='". $item->path ."' style='width:150px; height: 150px'/></a>
						</div>
					</div>
					<div class='card'>
						<div class='card-body'>
							<a href='/profile/index/". $item->profile_id . "'>$item->name<h4></h4></a>
							".  "</br>
							<form action='/relation/removeRelation/" . $item->profile_id . "/" . $_GET['url'] ."'>"
							. $removeRelationBtn ."
							</form>
						</div>
						<div class='footer'>
						    <small class='text-muted float-right' style='margin-right: 5px'>Average Rating:  	" . $item->avg . "</small>
						</div>
					</div>
				</div>
			";
		}
		print "</div>";
	}
?>