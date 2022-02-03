var passwordRow = document.getElementsByClassName('password-row')[0];
var newPasswordRow = document.getElementsByClassName('new-password-row')[0];
var newpasswordRowConfirmation = document.getElementsByClassName('password-confirmation-row')[0];

if(document.getElementById("edit-password") != null)	
{
	document.getElementById("edit-password").addEventListener("click", function() {
		newPasswordRow.style.display='block';
		newpasswordRowConfirmation.style.display='block';
		passwordRow.style.display = "none";
		document.getElementById("edit-password").style.display = "none";
		document.getElementById("cancel-password").style.display = "block";
	}); 
}

if(document.getElementById("cancel-password") != null)	
{
	document.getElementById("cancel-password").addEventListener("click", function() {
		newPasswordRow.style.display='none';
		newpasswordRowConfirmation.style.display='none';
		passwordRow.style.display = "block";
		document.getElementById("edit-password").style.display = "block";
		document.getElementById("cancel-password").style.display = "none";
	}); 
}