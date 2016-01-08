// JavaScript Document

//logo's height

$(function()
{
    var headHeight=$(".head").height();
	var logoHeight=$(".head span img").height();
	var logoMargin=(headHeight-logoHeight)/2;
	
	$(".head span img").css("margin-top",logoMargin+"px");
})

//video's size
/*
$(function()
{
    var windowWidth=$(window).width();
	
	$(".videocase").css("width",windowWidth+"px");
	$(".videocase img").css("width",windowWidth+"px");
	$(".videocase").css("height",windowWidth*0.75+"px");
	
	var videocaseHeight=$(".videocase").height();
	
	$(".layer_videoinfo").css("width",windowWidth+"px");
	$(".layer_videoinfo").animate({"opacity":0.6}).fadeIn(100);
	$(".layer_out").css("margin-left",windowWidth-$(".layer_out").width()-10+"px");
})*/

//list's margin

$(function()
{
    var windowWidth=$(window).width();
	/*var unitWidth=$("ul li").width()*2;
	var unitmargin=(windowWidth-unitWidth)/3;
		
	$("ul li").css("margin-left",unitmargin+"px");
	$("ul li").css("margin-top",unitmargin+"px");*/

	$("ul li").css("margin-left", "3%");
	$("ul li").css("margin-top", "0");
	$(".imgcase").css("height",$("ul li").width()*0.75+"px");
	$(".imgcase img").css("width",$("ul li").width()+"px");
	
	var imgcaseHeight=$(".imgcase").height();
	
	$(".layer_imgcase").animate({"opacity":0.6}).fadeIn(100);
	$(".layer_imgcase").css("width",$("ul li").width()+"px");
	$(".arrow-right").css("margin-left",windowWidth-$(".userlist").width()*0.1+"px");
	$(".spicle-arrow-right").css("margin-left",windowWidth-$(".talklist").width()*0.1+"px");
	
	$(".layer_action").animate({"opacity":1.0}).fadeIn(100);
})

//userlist

$(function()
{    
	var mySwiper=new Swiper
	(
	    ".swiper-container-carousel",
		{
           loop:true,
		   slidesPerView:9,
           slidesPerGroup:1
        }
   )
   
   $(".arrow-left").on("click",function(e){e.preventDefault();mySwiper.swipePrev();})
   $(".arrow-right").on("click",function(e){e.preventDefault();mySwiper.swipeNext();})
   
   $(".carouselcase").hover
   (
       function(){$(".arrow-left,.arrow-right").fadeIn();},
	   function(){$(".arrow-left,.arrow-right").fadeOut();}
   )
}
)

//talklist

$(function()
{    
	var mySwiper=new Swiper
	(
	    ".swiper-container-spicle",
		{
           loop:true,
		   slidesPerView:1,
           slidesPerGroup:1
        }
   )
   $(".spicle-arrow-left").on("click",function(e){e.preventDefault();mySwiper.swipePrev();})
   $(".spicle-arrow-right").on("click",function(e){e.preventDefault();mySwiper.swipeNext();})
   
   $(".spiclecase").hover
   (
       function(){$(".spicle-arrow-left,.spicle-arrow-right").fadeIn();},
	   function(){$(".spicle-arrow-left,.spicle-arrow-right").fadeOut();}
   )
}
)

//talkinfo

$(function()
{
    $("#click").on
	(
	    "click",
		function()
		{
			var talkinfoHeight=$(".talkinfo").height();
			
			if($(this).hasClass("putup"))
			{
			    $(this).removeClass("putup").addClass("putdown");
				$(".talkinfo").hide();
			}
			else
			{
				$(this).removeClass("putdown").addClass("putup");
			    $(".talkinfo").show();
			}
			
		}
		
	)
}
)

