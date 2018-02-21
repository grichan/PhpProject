<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</head>

<div class="container">
        <br>
        <div class="row">
            <div class="col">
                <form  method="post" action=""  id="searchform" class="form-group" >
                    <input id="search" type="text" name="name">
                    <button  type="submit" name="submit" value="Search" class="btn">Search</button>
                </form>
            </div>
            <div class="col">
                <form action="add.php" method=\"POST\">
                    <button name=\"Edit\" value=""  class="btn btn-primary float-right add" ">Add new User</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div id='response'>Click Search To view All</div>
        </div>
</div>

<script>
    function onPageButtonClicked(e) {
        e.preventDefault(); // The default event will not be triggered
        var page_number = localStorage.getItem('page');

        e.preventDefault(); // The default event will not be triggered

        var ajaxParams = {};
        ajaxParams.type = "POST";
        ajaxParams.url = "../<?=TEMPLATES_PATH?>/searchResponse.php";    // SeparateSearchResponse.php
        ajaxParams.data = { "type": $(this).attr('id'), "search": $('#search').val() ,  page: page_number  };

        $.ajax(ajaxParams).done(onSearchRedy).fail(onSearchFail);
        return false;

    }

    function onSearchFail(data) {
        alert( "Posting failed." + JSON.parse(data)  );
    }
    function onSearchRedy(data) {
        // show the response
        $('#response').html(data);
    }
    function onSearchSumbitClick(e) {
        var page_number = localStorage.getItem('page');

        e.preventDefault(); // The default event will not be triggered

        var ajaxParams = {};
        ajaxParams.type = "POST";
        ajaxParams.url =  "../<?=TEMPLATES_PATH?>/searchResponse.php";
        ajaxParams.data = { "type": $(this).val(), "search": $('#search').val() ,  page: page_number  };

        $.ajax(ajaxParams).done(onSearchRedy).fail(onSearchFail);
        return false;
    }
</script>
