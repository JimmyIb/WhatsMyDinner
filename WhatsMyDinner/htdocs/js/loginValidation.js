//inputs
var usernameInput = document.getElementById('usernameInput');
var passwordInput = document.getElementById('passwordInput');
//set error colors
var errorColor = '#ed9090';
var errorTextColor = 'red';
var correctColor = 'white';

//errorFields
var errorUsername = document.getElementById("errorUsername");
var errorPassword = document.getElementById("errorPassword");

//set colors
errorUsername.style.color = errorTextColor;
errorPassword.style.color = errorTextColor;

function formValidation(){
	clear();
	var isCorrect = true;
	if(usernameInput.value == ""){
		usernameInput.style.backgroundColor = errorColor;
		errorUsername.innerHTML = 'Username must be completed';
		isCorrect = false;
	}

	if(passwordInput.value == ""){
		passwordInput.style.backgroundColor = errorColor;
		errorPassword.innerHTML = 'Password must be completed';
		isCorrect = false;
	}
	return isCorrect;
}
function clear(){
	usernameInput.style.backgroundColor = correctColor;
	passwordInput.style.backgroundColor = correctColor;
	errorPassword.innerHTML = "";
	errorUsername.innerHTML = "";
}