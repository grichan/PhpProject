<?php
session_start();
if (isset($_SESSION['logged_in']) == true)
{
    session_destroy();
}
?>
<html>
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <script src="js/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="css/popper.min.js"></script>
    <script src="css/bootstrap.min.js"></script>
    </script>  <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
</head>
<?php require_once("../resources/config.php");?>



<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col">
                <button  data-toggle="modal" data-target="#registerModal"   class="btn btn-default float-right" >REGISTER</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row" id="wideRow">
            <div class="col"></div>
            <div class="col" ><h1 class="text-center">WELCOME TRAVELER</h1></div>
            <div class="col"></div>
        </div>
        <div class="row" id="imageRow">
            <div class="col"></div>
            <div class="col"><img src='<?=$config["paths"]["images"]["layout"]?>/birdLogo.png' class="img-responsive" alt="Bird Logo" draggable="false"></div>
            <div class="col"></div>
        </div>
        <div class="row" id="loginRow">
            <div class="col"></div>
            <div class="col">
                    <form class="form-group">
                        <label for="exampleInputPassword1">USERNAME</label>
                        <input required type="text" class="form-control" id="username" placeholder="username">
                        <label for="exampleInputPassword1">PASSWORD</label>
                        <input required type="password" class="form-control" id="password" placeholder="password">
                        <br>
                        <input id="login" type="submit" class="form-control transform" id="login">
                    </form>
            </div>
            <div class="col"></div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLable" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registration form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="reg_form">
                    <label for="email" required >Email:</label>
                    <input type="text" class="form-control" id="email" placeholder="example@example.com" required> 

                    <label for="password" required>Password: <a href="#" data-toggle="tooltip" title="At least: one capital letter, one number, 8 charecters long"><i class="fas fa-info-circle"></i></a> </label>
                    <input type="password" placeholder="Example1"  class="form-control" id="password_register" required>                   
                    <label for="password" required>Confirm Password: </label> 
                    <input type="password" placeholder="Example1"  class="form-control" id="password_register_confirm" required>
                    <div id="password_conf_alert"></div>
                    <div id="status_alert"></div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" value="Register" id="register">Register</button>
        </form>

        </div>
        </div>
    </div>
</div>


</body>
<script>
    function onLoginFail(data) {
        var result =  $.parseJSON( data );
        alert( result[0]);

    }
    function onLoginReady(data) {
        // show the response
        var result =  $.parseJSON( data );
        if( result[0] == "true"  ) {
            window.location.replace( result[1]);
        } else {
            alert( "Please Try again")
        }
        //alert(data[0]);

    }
    function onSubmitClick(e) {
        $('#login').toggleClass('transform-active');
        $('#login').toggleClass('transform-active');

        //alert("clicked!")
        //alert( "POST-type: " + $(this).attr('id'));
        var username = $( '#username').val();
        var password = $( '#password').val();
        //alert(username  + password)
        e.preventDefault(); // The default event will not be triggered

        var ajaxParams = {};
        ajaxParams.type = "POST";
        ajaxParams.url = "../<?=TEMPLATES_PATH?>/loginResponse.php";
        ajaxParams.data = { "username": username , "password": password  };
        $.ajax(ajaxParams).done(onLoginReady).fail(onLoginFail);
        return false;
    }    
</script>

<script src="../public_html/js/registration.js"></script>
<script>
    function onDocumentReady(){
        $(" #login").click(onSubmitClick);
        $("#register").click(registerAjax);
        $('[data-toggle="tooltip"]').tooltip();
                    
        }
        $(document).ready(onDocumentReady);       
</script>
<style>
    body{
        background: linear-gradient(275deg, #2a42c5, #057487, #013b5f);
        background-size:400% 400%;
        -webkit-animation: AnimationGradientTransition 20s ease infinite;
        -moz-animation: AnimationGradientTransition 20s ease infinite;
        animation: AnimationGradientTransition 20s ease infinite;

        }
    @-webkit-keyframes AnimationGradientTransition {
        0%{background-position:0% 50%}
        50%{background-position:100% 50%}
        100%{background-position:0% 50%}
    }
    @-moz-keyframes AnimationGradientTransition {
        0%{background-position:0% 50%}
        50%{background-position:100% 50%}
        100%{background-position:0% 50%}
    }
    @keyframes AnimationGradientTransition {
        0%{background-position:0% 50%}
        50%{background-position:100% 50%}
        100%{background-position:0% 50%}
    }

    #loginRow {
        color: rgba(240, 239, 255, 0.86);
    }
    .form-group > input[type="text"] ,.form-group > input[type="password"]
    {
         background: transparent;
         color:white;
    }
    #login{
        background: rgba(240, 239, 255, 0.94);
    }
    button {
        background: rgba(240, 239, 255, 0.97);
        margin-top: 0.3vw;
    }
    h1 {
        font-size: 65px;
        color: rgba(240, 239, 255, 0.97);
        font-family: 'Fjalla One', sans-serif;
    }
    #RegisterModal .modal-footer {
        justify-content: space-between;
    }

</style>
</html>
