<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</head>


<form method="GET" >
    <input type="text" id="text" name="name">
    <input type="submit" id="submit">
</form>

<div>
    <h1>

        <?=$_GET["name"]?>

    </h1>
</div>

<script>

    $("#submit").click(function() {
            //alert( "POST-type: " + $(this).attr('id'));
            var text = $("#text").val();
            alert(text);
            console.log(text);

        jQuery.ajax({
            type:"POST",
            dataType:"text",
            url: "getRecive.php?name=" + text + "" ,
            data:{ "name": name },
            success: function(data) {
                alert(data);

            },
            error: function(data) {
                alert("ERROR: " + JSON.stringify(data));
            }
        });
    });
    $( document ).ready(function() {

    });
</script>