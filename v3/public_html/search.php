<head>
    <script src="css/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <script src="css/bootstrap.min.js"></script>
    <script src="css/popper.min.js"></script>  
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
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
