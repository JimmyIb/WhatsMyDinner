<h2 style='margin: 5px;'>Reviews</h2>
<?php
  foreach($data as $value){
  print " 
    <div class='container' style='margin-top: 10px'>
      <div class='card'>
        <div class='card-body'>
        <a href='/post/viewPost/". $value->post_id ."' class='btn btn-info float-right'>View Post</a>
          <h5 class='card-title'>". $value->title ."</h5>
          <small class='text-muted'>Author: <a href='/profile/index/". $value->author_id . "'>" . $value->author ."</small></a>
          <div class='row'>
            <div class='d-flex justify-content-start' style='margin: 20px'>
            <figure>
              <img src='". $value->path ."' style='width:200px; height:150;' class='img-responsive'/><br/>
              <figcaption>
                <small class='text-muted'>Average Rating: ". round($value->avg,1) ."/5</small>
                </figcaption>
              </figure>
            </div>
            <div class='p-2 flex-grow-1'>
              <h6 class='card-title'>Review</h6><hr/>
              ". $value->review_content ."
            </div>
          </div>
          <div class='footer float-right'>
          <small class='text-muted'>". $value->name ." rated this recipe " . $value->rating ."/5</small>
          </div>
        </div>
      </div>
    </div>
    ";
}
if($data == null){
  print "This account did not post any reviews!";
}
?>