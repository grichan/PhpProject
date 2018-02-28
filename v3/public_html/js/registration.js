
function registerAjax(e) {
    console.log("registration clicked");    
    e.preventDefault();
    username = $("#email").val();
    password = $("#password_register").val();
    password_confirmation = $("#password_register_confirm").val();
    

    if ( username !== "" && password !== "" && password_confirmation !== "" ) {
        passwordReg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
        usernameReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if ( usernameReg.test(username) ){
            if( passwordReg.test(password) ){               
                if( password == password_confirmation ) {
                    $.ajax({
                        type: "POST",
                        url: "../resources/templates/registrationResponse.php",
                        data: { "username" : username, "password" : password, "password_confirmation" : password_confirmation },
                        success: function (response) {
                            alert( response);
                        }
                    });
                    $('#registerModal').modal('toggle');
                    $("#reg_form").trigger('reset');
                } else alert("Passwords don't match"); 
            } else alert("Incorrect password format");
        } else {
           alert("Invalid email");
        }
    } else alert("Please fill out all the fields");
}

    