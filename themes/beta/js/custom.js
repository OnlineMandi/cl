

$(document).ready(function(){

        if($("#ex12c").length){

            $("#ex12c").slider({
                id: "slider12c",
                min: 0,
                max: 900,
                range: true,
                value: [0, 900]
            });
            $("#ex12c").on("slide", function(slideEvt) {
                $("#ex12c-val").text("Price: Rs." + slideEvt.value[0] + " - Rs."+ slideEvt.value[1]);
            });
        }
        if($("#ex12d").length){
            $("#ex12d").slider({
                id: "slider12d",
                min: 1,
                max: 34,
                range: true,
                value: [1, 34]
            });
            $("#ex12d").on("slide", function(slideEvt) {
                $("#ex12d-val").text("Range: " + slideEvt.value[0] + " - "+ slideEvt.value[1]);
            });
        }
        if($("#ex12e").length){

            $("#ex12e").slider({
                id: "slider12e",
                min: 1,
                max: 36,
                range: true,
                value: [1, 36]
            });
            $("#ex12e").on("slide", function(slideEvt) {
                $("#ex12e-val").text("Range: " + slideEvt.value[0] + " - "+ slideEvt.value[1]);
            });
        }
        if($("#ex12f").length){

            $("#ex12f").slider({
                id: "slider12f",
                min: 1,
                max: 35,
                range: true,
                value: [1, 35]
            });
            $("#ex12f").on("slide", function(slideEvt) {
                $("#ex12f-val").text("Range: " + slideEvt.value[0] + " - "+ slideEvt.value[1]);
            });
        }
        if($("#ex12g").length){

            $("#ex12g").slider({
                id: "slider12g",
                min: 1,
                max: 35,
                range: true,
                value: [1, 35]
            });
            $("#ex12g").on("slide", function(slideEvt) {
                $("#ex12g-val").text("Range: " + slideEvt.value[0] + " - "+ slideEvt.value[1]);
            });
        }


        if($("#ex12h").length){

            $("#ex12h").slider({
                id: "slider12h",
                min: 1,
                max: 35
            });
            $("#ex12h").on("slide", function(slideEvt) {
                $("#ex12h-val").text(slideEvt.value);
            });

        }
        if($("#ex12i").length){

            $("#ex12i").slider({
                id: "slider12i",
                min: 1,
                max: 35
            });
            $("#ex12i").on("slide", function(slideEvt) {
                $("#ex12i-val").text(slideEvt.value);
            });

        }
        if($("#ex12j").length){

            $("#ex12j").slider({
                id: "slider12j",
                min: 1,
                max: 35
            });
            $("#ex12j").on("slide", function(slideEvt) {
                $("#ex12j-val").text(slideEvt.value);
            });

        }
        if($("#ex12k").length){

            $("#ex12k").slider({
                id: "slider12k",
                min: 1,
                max: 35
            });
            $("#ex12k").on("slide", function(slideEvt) {
                $("#ex12k-val").text(slideEvt.value);
            });

        }
        if($("#ex12l").length){

            $("#ex12l").slider({
                id: "slider12l",
                min: 1,
                max: 35
            });
            $("#ex12l").on("slide", function(slideEvt) {
                $("#ex12l-val").text(slideEvt.value);
            });

        }




    $("body").on("mouseover","text.headline,text.headline1",function(){
           $(this).css("fill","url('#mypattern1') none");
       });
       $("body").on("mouseout","text.headline,text.headline1",function(){
           $(this).css("fill","url('#mypattern') none");
       });

        function stopnav(){
            var high = $(".header").height();
            $("<div class='header-bg'></div>").css("height",high).insertBefore(".header");
            var hight = $(".sub-menu").height();
            $(".right-list").css("height",hight);
        }
        stopnav();



        $('.bxslider').bxSlider({
            auto: true,
            autoControls: true,
            nextText: '',
            prevText: ''
        });


        function runSlider(val){
            $('.bxslider-sellers').bxSlider({
                minSlides: 1,
                maxSlides: val,
                moveSlides:1,
                slideWidth: 262,
                slideMargin: 30,
                auto: true,
                autoControls: true,
                pager:false
            });
            $('.bxslider-sellers-sd').bxSlider({
                 minSlides: 1,
                 maxSlides: val,
                 moveSlides:1,
                 slideWidth: 262,
                 slideMargin: 30,
                 auto: true,
                 autoControls: true,
                 pager:false
             });
        }

        var winwid = $(window).width();

        if(winwid<591)
        {
            runSlider(1);
        }
        else if(winwid<768){
            runSlider(2);
        }
        else{
            runSlider(4);
        }


         if(winwid<768){

             $(".navbar-toggle").click(function(event){
                 var target = $( event.target );

                if(target.is(".collapsed"))
                {
                    $(".mobi-menu").animate({
                        left:0
                    },400);
                    $(".bg").fadeIn();
                }
                 else{
                    $(".mobi-menu").animate({
                        left:"-240px"
                    },400);
                    $(".bg").fadeOut();
                }


             });
             $(".bg").click(function(){
                 $(this).fadeOut();
                 $(".mobi-menu").animate({
                     left:"-240px"
                 },400);
                 $(".navbar-toggle").addClass("collapsed");
             });

             function handler( event ) {
                 var target = $(event.target);
                 if (target.is("a.main-li")) {
                     if(!target.parent().children("ul").is(":visible"))
                     {
                         target.parents("ul").find("ul").slideUp();
                         target.parents("ul").find("a.main-li i").addClass("fa-plus");
                         target.parents("ul").find("a.main-li i").removeClass("fa-minus");
                     }
                     target.parent().children("ul").slideToggle();
                    if(target.children("i").hasClass("fa-plus")){
                        target.children("i").removeClass("fa-plus");
                        target.children("i").addClass("fa-minus");
                    }
                     else{
                        target.children("i").addClass("fa-plus");
                        target.children("i").removeClass("fa-minus");
                    }
                 }
             }
             $(".sub-menu-mobi").click(handler);



         }
         else{
             $(".main-ul>li").hover(function(){
                 $(this).children(".sub-menu").stop(true,false).fadeIn().css("top","100%");

             },function(){
                 $(this).children(".sub-menu").stop(true,false).fadeOut().css("top","150%");

             });
         }
        $(".left-bar h3").on("click",function(event){
            var target = $(event.target);

            if(target.next().is(":visible"))
            {
                $(this).children("i").removeClass("fa-minus");
                $(this).children("i").addClass("fa-plus");
            }
            else{
                $(this).children("i").removeClass("fa-plus");
                $(this).children("i").addClass("fa-minus");
            }

            $(this).next("div").slideToggle();
        });







        $(".sub-menu-men>.left-list>li").on("mouseover",function(){
            $(".sub-menu-men>.left-list>li").removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $(".sub-menu-men>.right-list>div").hide();
            $(".sub-menu-men>.right-list>div:eq('"+index+"')").fadeIn();
        });

        $(".sub-menu-women>.left-list>li").on("mouseover",function(){
            $(".sub-menu-women>.left-list>li").removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $(".sub-menu-women>.right-list>div").hide();
            $(".sub-menu-women>.right-list>div:eq('"+index+"')").fadeIn();
        });

        $('[data-popup-id="login"]').click(function(){
			$('[data-popup="signup"]').css("display","none");
            $('[data-popup="login"]').css("display","flex");
            $('[data-popup="login"]').children("div").fadeIn().css("top","0");
        });
        $('[data-popup-close="login"]').click(function(event){
			$('[data-popup="signup"]').css("display","none");
            var target = $(event.target);
            if (target.is('[data-popup-close="login"]')){
                $('[data-popup="login"]').children("div").fadeIn().css("top","-100%");
                $('[data-popup="login"]').css("display","none");
				$(this).find('form')[0].reset();
            }
        });
		
		 $('[data-popup-id="signup"]').click(function(){
			 $('[data-popup="login"]').css("display","none");
            $('[data-popup="signup"]').css("display","flex");
            $('[data-popup="signup"]').children("div").fadeIn().css("top","0");
        });
        $('[data-popup-close="signup"]').click(function(event){
			$('[data-popup="login"]').css("display","none");
            var target = $(event.target);
            if (target.is('[data-popup-close="signup"]')){
                $('[data-popup="signup"]').children("div").fadeIn().css("top","-100%");
                $('[data-popup="signup"]').css("display","none");
				$(this).find('form')[0].reset();
            }
        });
		
		

		$('.editable').hide();
		$('.edit_admin_display').click(function() {
			target = $(this).attr('target-class');
			type = $(this).attr('attr-type');
			if(type == 'edit'){
				$(this).text('save');
				$(this).attr('attr-type','save');
				
/* 				$( '.'+target+' span' ).each(function() {
					var html = $(this).text();
					var cls = $(this).attr('class');
					var id = $(this).attr('id');
					var input = $('<input type="text" id="'+id+'" name="'+cls+'" />');
					input.val(html);
					$(this).replaceWith(input);

				}); */
				$('.'+target).find('.readable').hide();			
				$('.'+target).find('.editable').show();

			}else{
				id = $( '.'+target+' form').attr('id');

				response = $('#'+id).yiiActiveForm('submitForm');
				return false;
				
							
			}
		});
		


        $(".decrease").click(function(){
            var value = $("#range").val();
            value--;
            if(value<1){
                return;
            }
            $("#range").val(value);
        });
        $(".increase").click(function(){
            var value = $("#range").val();
            value++;
            $("#range").val(value);
        });

        $(".product-tab-head a").on("click",function(){
            $(".product-tab-head a").removeClass();
            $(this).addClass("active");
            var index = $(this).index();
            $(".product-tab-body>div").hide();
            $(".product-tab-body>div:eq('"+index+"')").fadeIn();
        });		
});

