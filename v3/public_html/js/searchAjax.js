function onSearchFail(data) {
  // just in case posting your form failed
  alert("Posting failed." + JSON.parse(data));
}
function onSearchRedy(data) {
  // show the response
  $("#response").html(data);
  //alert(data[0]);
}
function onSearchSumbitClick(e) {
  var page_number = localStorage.getItem("page");

  e.preventDefault(); // The default event will not be triggered
  var ajaxParams = {};
  ajaxParams.type = "POST";
  ajaxParams.url = "../<?=TEMPLATES_PATH?>/searchResponse.php";
  ajaxParams.data = {
    type: $(this).val(),
    search: $("#search").val(),
    page: page_number
  };

  $.ajax(ajaxParams)
    .done(onSearchRedy)
    .fail(onSearchFail);
  return false;
}
