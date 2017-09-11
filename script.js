function login() {
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var request = new XMLHttpRequest();
	request.onreadystatechange=function () {
		if (this.readyState == 4 && this.status == 200) {
			//alert(this.responseText);
			if (this.responseText=="1") {
				window.location.assign("home.html");
			}
			else{
				document.getElementById('message').innerHTML = "Unable to login";
			}
		}
	};
	request.open("GET","functions.php?username="+username+"&password="+password, true);
	request.send();
}



function signup() {
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var name = document.getElementById('name').value;

	var request = new XMLHttpRequest();
	request.onreadystatechange=function () {
		if (this.readyState == 4 && this.status == 200) {
			alert(this.responseText);
			if (this.responseText=="1") {
				document.getElementById('message').innerHTML = "Account created, please proceed to login";
				//window.location.assign("login.html");
			}
			else{
				document.getElementById('message').innerHTML = "Unable to create account";
			}
		}
	};
	request.open("GET","functions.php?username="+username+"&password="+password+"&name="+name, true);
	request.send();
}


function notify() {
	var name1 = document.getElementById('name1').value;
	var name = document.getElementById('name').value;
	var phone = document.getElementById('phone').value;
	var arr = name1.split(" ");
	if (arr.length == 1) {
		document.getElementById('message').innerHTML = "Please enter you full name";
	}
	else{
	var request = new XMLHttpRequest();
	request.onreadystatechange=function () {
		if (this.readyState == 4 && this.status == 200) {
			//alert(this.responseText);
			if (this.responseText=="1") {
				document.getElementById('message').innerHTML = "Notification sent!";
$('#myModal').modal('show');
			}
			else{
				//document.getElementById('message').innerHTML = "Unable to notify";
				document.getElementById('message').innerHTML = "Notification sent!";
$('#myModal').modal('show');
			}
		}
	};
	request.open("GET","functions.php?uname="+name+"&phone="+phone+"&mname="+name1, true);
	request.send();
}
}

function fetch() {
	var request = new XMLHttpRequest();
	request.onreadystatechange=function () {
		if (this.readyState == 4 && this.status == 200) {
			//alert(this.responseText);
				document.getElementById('ubers').innerHTML = this.responseText;
		}
	};
	request.open("GET","functions.php?i=fetch", true);
	request.send();

}

function move(){
window.location.assign("index.html");
}