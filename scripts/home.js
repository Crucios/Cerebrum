// JavaScript Document
function refresh(){

}

$(document).ready(function(){
  $("#joinClass_confirm").click(function(){
    var code = $("#joinClass_text")).val()

    $.post("phps/joinClass.php",{
      code:code
    },
    function(response){
      refresh("");
      alert(response);
    });
  });

  $("#createClass_confirm").click(function(){
    var name = $("#nameClass_text").val()
    var desc = $("#descriptionClass_text").val()

    $.post("phps/addClass.php",{
      name:name,
      desc:desc
    },
    function(response){
      refresh("");
      alert(response);
    });
  });
});
