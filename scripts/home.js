// JavaScript Document
function refresh(){

}

$(document).ready(function(){
  $("#joinClass_confirm").click(function(){

  });

  $("#createClass_confirm").click(function(){
    var name = $("#nameClass_text").val()
    var desc = $("#descriptionClass_text").val()

    $.post("../php/addClass.php",{
      name:name,
      desc:desc
    },
    function(response){
      refresh("");
      alert(response);
    });
  });
});
