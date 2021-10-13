

function createUser() {
    if (document.getElementById('registerUsername').value !== "" && document.getElementById('registerPassword').value !== "" && document.getElementById('registerEmail').value !== "") {
        if (document.getElementById('registerPassword').value == document.getElementById('registerPassword1').value) {
            $.post("https://scheduler.8thkg.team/api/login/createlogin", {
                username: document.getElementById('registerUsername').value,
                password: document.getElementById('registerPassword').value,
                email: document.getElementById('registerEmail').value,
            }, function(data,status){
                document.getElementById('registerUsername').value = "";
                document.getElementById('registerPassword').value = "";
                document.getElementById('registerPassword1').value = "";
                document.getElementById('registerEmail').value = "";
                $('#modalRegister').click();
                alert("Please sign in using your new credentials.");
            }) .fail(function() {
                alert("Unable to create the user, please ensure the information is correct");
            })
        } else {
            document.getElementById('registerPassword').style.borderColor = "red";
            document.getElementById('registerPassword1').style.borderColor = "red";
            alert("Passwords don't match");
        }
    } else {
        alert("Please fill out all the fields");
    }
}

function createNewEvent() {
    alert("create Start");
    if (document.getElementById('registerEventName').value !== "" && document.getElementById('registerEventStart').value !== "" && document.getElementById('registerEventStop').value !== "" && document.getElementById('registerEventDescription').value !== "") {
        alert("create 1");
        $.post("https://scheduler.8thkg.team/api/event/createEvent", {
                eventName: document.getElementById('registerEventName').value,
                eventstart: document.getElementById('registerEventStart').value,
                eventstop: document.getElementById('registerEventStop').value,
                description: document.getElementById('registerEventDescription').value,
            
            }, function(data,status){
                alert("create 3");
                document.getElementById('registerEventName').value = "";
                document.getElementById('registerEventStart').value = "";
                document.getElementById('registerEventStop').value = "";
                document.getElementById('registerEventDescription').value = "";
                $('#modalRegister').click();
                alert("Event successfully created");
            }) .fail(function() {
                alert("Unable to create the event, please ensure the information is correct");
            })
    } else {
        alert("Please fill out all the fields");
    }
}

function login(){
	var username = document.getElementById('InputUsername').value;
	var password = document.getElementById('InputPassword').value;

	$.post('https://scheduler.8thkg.team/api/login/userlogin', {
		username: username,
		password: password
	}, function(data,status){
		window.location.href = window.location
	}) .fail(function() {
		alert("Wrong username or password");
	})
}



$( document ).ready(function() {
    setEnterListener(login ,document.getElementById("InputUsername"));
    setEnterListener(login ,document.getElementById("InputPassword"));
    setEnterListener(createUser ,document.getElementById("registerUsername"));
    setEnterListener(createUser ,document.getElementById("registerPassword"));
    setEnterListener(createUser ,document.getElementById("registerPassword1"));
    setEnterListener(createUser ,document.getElementById("registerEmail"));

    setEnterListener(createNewEvent ,document.getElementById("registerEventName"));
    setEnterListener(createNewEvent ,document.getElementById("registerEventStart"));
    setEnterListener(createNewEvent ,document.getElementById("registerEventStop"));
    setEnterListener(createNewEvent ,document.getElementById("registerEventDescription"));

});

function setEnterListener(functionParam, htmlElement) {
    // Execute a function when the user releases a key on the keyboard
    htmlElement.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Trigger the button element with a click
        functionParam();
        }
    }); 
}
