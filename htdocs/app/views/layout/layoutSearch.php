<form class="form-inline my-2 my-lg-0" method='get' name='searchForm' onsubmit='return submitForm()'action='/post/search/'>
	<input class="form-control mr-sm-2" type="search" placeholder="Search"  id='searchInput' name="search">
	<button class="btn btn-outline-light" type="submit">Search</button>
</form>
<script>
	function submitForm(){
		var searchData = document.forms["searchForm"]["search"].value;
		if(searchData.trim() == ""){
			return false;
		}
	}
</script>