$(document).ready(function(){
  $("p.p1").click(function(){
    $("#div2").show();
    $("#div3").hide();
  });
   $("p.p2").click(function(){
    $("#div3").show();
    $("#div2").hide();
  });
});