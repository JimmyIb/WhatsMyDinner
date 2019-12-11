
		<div class='border' style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); margin-bottom: 20px; padding: 20px; border-radius: 25px">
			<h4>Add a Review!</h4>
			<form method='post' action="/review/addReview/ <?php echo $data->post_id?>">
				<div class='form-group row'>
					<div class='col-lg-9'>
						<label>Content: </label>
						<textarea class='form-control'name="review" placeholder="Enter Review"></textarea><br/>
					</div>
				
				<div class='col-lg-2'>
					<label>Rating on 5:</label> 
					<input class='form-control' type='number' name='rating' min='0' max='5'/><br/>
					<input class='form-control btn btn-success' type="submit" name="submit" value="Submit"/>
				</div>
			</div>
			</form>
		</div>
