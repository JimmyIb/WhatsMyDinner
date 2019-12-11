//inputs
var firstNameInput = document.getElementById('fNameInput');
var lastNameInput = document.getElementById('lNameInput');
//set error colors
var errorColor = '#ed9090';
var errorTextColor = 'red';
var correctColor = 'white';

//errorFields
errorFirstName = document.getElementById('errorFirstName');
errorLastName = document.getElementById('errorLastName');

//set colors
errorFirstName.style.color = errorTextColor;
errorLastName.style.color = errorTextColor;

function validateForm(){
	clear();
	var isCorrect = true;
	if(firstNameInput.value == ""){
		errorFirstName.innerHTML = "First name must be completed";
		firstNameInput.style.backgroundColor = errorColor;
		isCorrect = false;
	}else if(firstNameInput.value.length > 20){
		firstNameInput.style.backgroundColor = errorColor;
		errorFirstName.innerHTML = "First name must be less than 20 characters";
		isCorrect = false;
	}

	if(lastNameInput.value == ""){
		errorLastName.innerHTML = "Last name must be completed";
		lastNameInput.style.backgroundColor = errorColor;
		isCorrect = false;
	}else if(lastNameInput.value.length > 20){
		lastNameInput.style.backgroundColor = errorColor;
		errorLastName.innerHTML = "Last name must be less than 20 characters";
		isCorrect = false;
	}
	return isCorrect;
}
function clear(){
	firstNameInput.style.backgroundColor = correctColor;
	lastNameInput.style.backgroundColor = correctColor; 
	errorLastName.innerHTML = "";
	errorFirstName.innerHTML = "";
}