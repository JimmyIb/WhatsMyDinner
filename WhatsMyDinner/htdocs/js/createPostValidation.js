//inputs
	var titleInput = document.getElementById('titleTextArea');
	var descriptionInput = document.getElementById('descriptionTextArea');
	var ingredientsInput = document.getElementById('ingredientsTextArea');
	var directionsInput = document.getElementById('directionsTextArea');
	var cookTimeInput = document.getElementById('cookTimeInput');
	var prepTimeInput = document.getElementById('prepTimeInput');
	var portionsInput = document.getElementById('portionsInput');
	var typeInput = document.getElementById('typeInput');
	//set error colors
	var errorColor = '#ed9090';
	var errorTextColor = 'red';
	var correctColor = 'white';
	//errorTexts
	var errorText = document.getElementById('errorText');
	var errorCookTime = document.getElementById('errorCookTime');
	var errorPrepTime = document.getElementById('errorPrepTime');
	var errorPortions = document.getElementById('errorPortions');
	//set all error text colors
	errorText.style.color = errorTextColor;
	errorCookTime.style.color = errorTextColor;
	errorPrepTime.style.color = errorTextColor;
	errorPortions.style.color = errorTextColor;
function validateForm(){
	clear();
	var allFieldsFilled = true;

	if(titleInput.value.trim() == ""){
		titleInput.style.backgroundColor = errorColor;
		allFieldsFilled = false;
	}
	if(descriptionInput.value.trim() == ""){
		descriptionInput.style.backgroundColor = errorColor;
		allFieldsFilled = false;
	}
	
	if(ingredientsInput.value.trim() == ""){
		ingredientsInput.style.backgroundColor = errorColor;
		allFieldsFilled = false;
	}
	if(directionsInput.value.trim() == ""){
		directionsInput.style.backgroundColor = errorColor;
		allFieldsFilled = false;
	}
	
	if(cookTimeInput.value.trim() == ""){
		cookTimeInput.style.backgroundColor = errorColor;
		allFieldsFilled = false;
	}else{
		if(cookTimeInput.value.trim() <= 0 ){
			cookTimeInput.style.backgroundColor = errorColor;
			errorCookTime.innerHTML = "Cook time must be larger than 0";
			allFieldsFilled = false;
		}else if(cookTimeInput.value.trim() > 999){
			cookTimeInput.style.backgroundColor = errorColor;
			errorCookTime.innerHTML = "Cook time must be less than 999";
			allFieldsFilled = false;
		}
	}
	if(prepTimeInput.value.trim() == ""){
		prepTimeInput.style.backgroundColor = errorColor;
		allFieldsFilled = false;
	}else{
		if(prepTimeInput.value.trim() <= 0 ){
			prepTimeInput.style.backgroundColor = errorColor;
			errorPrepTime.innerHTML = "Prep time must be larger than 0";
			allFieldsFilled = false;
		}else if(prepTimeInput.value.trim() > 999){
			prepTimeInput.style.backgroundColor = errorColor;
			errorPrepTime.innerHTML = "Prep time must be less than 999";
			allFieldsFilled = false;
		}
	}

	if(portionsInput.value.trim() == ""){
		portionsInput.style.backgroundColor = errorColor;
		allFieldsFilled = false;
	}else{
		if(portionsInput.value.trim() <= 0 ){
			portionsInput.style.backgroundColor = errorColor;
			errorPortions.innerHTML = "Portions must be larger than 0";
			allFieldsFilled = false;
		}else if(portionsInput.value.trim() > 999){
			portionsInput.style.backgroundColor = errorColor;
			errorPortions.innerHTML = "Portions must be less than 999";
			allFieldsFilled = false;
		}
	}

	if(typeInput.value.trim() == ""){
		typeInput.style.backgroundColor = errorColor;
		allFieldsFilled = false;
	}

	if(!allFieldsFilled){
		errorText.innerHTML = "Please complete all the highlighted fields";
		errorText.style.textAlign = 'center';

	}
	return allFieldsFilled;
}
function clear(){
	titleInput.style.backgroundColor = correctColor;
	descriptionInput.style.backgroundColor = correctColor;
	ingredientsInput.style.backgroundColor = correctColor;
	directionsInput.style.backgroundColor = correctColor;
	cookTimeInput.style.backgroundColor = correctColor;
	prepTimeInput.style.backgroundColor = correctColor;
	portionsInput.style.backgroundColor = correctColor;
	typeInput.style.backgroundColor = correctColor;
	
	errorText.innerHTML = "";
	errorPortions.innerHTML = "";
	errorCookTime.innerHTML = "";
	errorPrepTime.innerHTML = "";
}