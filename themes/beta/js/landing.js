$(document).ready(function(){

       $("body").on("mouseover","text.headline,text.headline1",function(){
           $(this).css("fill","url('#mypattern1') none");
       });
       $("body").on("mouseout","text.headline,text.headline1",function(){
           $(this).css("fill","url('#mypattern') none");
       });

});
