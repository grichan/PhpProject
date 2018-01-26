<?php
session_start();
if (isset($_SESSION['logged_in']) == true)
{
    session_destroy();
}


?>

<html>

<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
</head>
<?php
    require_once("../resources/config.php");
?>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col">
                <button class="btn btn-default float-right" >REGISTER</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row" id="wideRow">
            <div class="col"></div>
            <div class="col" ><h1 class="align-middle">WELCOME TRAVELER</h1></div>
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
                        <input type="text" class="form-control" id="username" placeholder="username">
                        <label for="exampleInputPassword1">PASSWORD</label>
                        <input type="text" class="form-control" id="password" placeholder="password">
                        <br>
                        <input id="submit" type="submit" class="form-control transform" id="login">
                    </form>
            </div>
            <div class="col"></div>

        </div>
    </div>
</body>

<script>

    function onLoginFail(data) {
        // just in case posting your form failed
        alert( "Posting failed." );

    }

    function onLoginReady(data) {
        // show the response
        var result =  $.parseJSON( data );
        alert( result[0] );
        window.location.replace( result[1]);
        //alert(data[0]);

    }

    function onSubmitClick(e) {

        $('#submit').toggleClass('transform-active');
        $('#submit').toggleClass('transform-active');

        //alert("clicked!")
        e.preventDefault(); // The default event will not be triggered
        //alert( "POST-type: " + $(this).attr('id'));
        var username = $( '#username').val();
        var password = $( '#password').val();
        //alert(username  + password)
        e.preventDefault(); // The default event will not be triggered

        // var bla = $('#page').val();
        // alert(bla);

        /*
         * 'post_receiver.php' - where you will pass the form data
         * $(this).serialize() - to easily read form data
         * function(data){... - data contains the response from post_receiver.php
         */
        var ajaxParams = {};
        ajaxParams.type = "POST";
        ajaxParams.url = "../<?=TEMPLATES_PATH?>/loginResponse.php";
        ajaxParams.data = { "username": username , "password": password  };
        $.ajax(ajaxParams).done(onLoginReady).fail(onLoginFail);
        return false;
    }


    function onDocumentReady(){
        $(" #submit").click(onSubmitClick);
    }
    $(document).ready(onDocumentReady);
</script>

<style>
    body{
        background: linear-gradient(to right, rgba(1, 32, 60, 0.8), #057487);
    }

    #loginRow {
        color: rgba(240, 239, 255, 0.86);
    }
    #loginRow {

    }
    #login {

    }
     input[type="text"]
    {
         background: transparent;
         color:white;
    }
    #login{
        background: rgba(240, 239, 255, 0.94);
    }
    h1{
        font-size: 3.2vw;
        color: rgba(240, 239, 255, 0.97);
        font-family: 'Fjalla One', sans-serif;
    }
    button {
        background: rgba(240, 239, 255, 0.97);
        margin-top: 0.3vw;
    }

    .transform {
        -webkit-transition: all 1s ease;
        -moz-transition: all 1s ease;
        -o-transition: all 1s ease;
        -ms-transition: all 1s ease;
        transition: all 1s ease;
    }

    .transform-active {
        background-color: rgb(172, 172, 183);
    }

</style>
</html>
