$(function(){var e;$(".side-section .btns li").mouseenter(function(){var f=$(this);if(f.hasClass("selected")){return}var g=$(this).index()+1;e=setTimeout(function(){var h=$(".sidefloor .detail .item.active");$(".side-section .btns li").removeClass("selected");f.addClass("selected");h.removeClass("active").addClass("hide");$(".sidefloor .detail .item"+g).removeClass("hide").addClass("active")},200)}).mouseleave(function(){clearTimeout(e)});$(".floor1 .f-right .tab").click(function(){if($(this).hasClass("selected")){return}$(".floor1 .f-right .tab").toggleClass("selected");$(".floor1 .f-right .subitem").toggle()});var d=new uc.SliderPlayer({wrap:"#marketSliderPlayer",elementSelector:".marketelement",size:{width:280,height:210},playTimes:5000});$(".floor5 .f-left ul .ksbtn").click(function(f){if($(this).hasClass("disabled")){return}c(f,195)});function c(k,f){var h=$(k.target);var j=$("#pingtaiDiv").css("width",f*$("#pingtaiDiv li").length+"px");var g=j.width();var i=parseInt(j.css("left"));$(".floor5 .f-left ul .ksbtn").removeClass("disabled");if(h.hasClass("next")){j.animate({left:i-f+"px"},500,function(){i=parseInt(j.css("left"));if((g+i)==3*f){h.addClass("disabled")}})}else{j.animate({left:i+f+"px"},500,function(){i=parseInt(j.css("left"));if(i==0){h.addClass("disabled")}})}}b();function b(){var f=$(".main_image .element").length;if(f<=1){return}for(var g=1;g<=f;g++){$('<a href="#">'+g+"</a>").appendTo(".main_visual .flicking_con")}$dragBln=false;$(".main_image").touchSlider({flexible:true,speed:800,btn_prev:$("#btn_prev"),btn_next:$("#btn_next"),paging:$(".flicking_con a"),counter:function(h){$(".flicking_con a").removeClass("on").eq(h.current-1).addClass("on")}});$(".main_image").bind("mousedown",function(){$dragBln=false});$(".main_image").bind("dragstart",function(){$dragBln=true});$(".main_image .flicking_con a").click(function(){if($dragBln){return false}});timer=setInterval(function(){$("#btn_next").click()},5000);$(".main_visual").hover(function(){clearInterval(timer)},function(){timer=setInterval(function(){$("#btn_next").click()},5000)});$(".main_image").bind("touchstart",function(){clearInterval(timer)}).bind("touchend",function(){timer=setInterval(function(){$("#btn_next").click()},5000)})}$(window).scroll(function(){var f=$(window).scrollTop();if(f>100){$("#homeRightBar").fadeIn(200)}else{$("#homeRightBar").fadeOut(200)}});$("#searchProduct").click(function(){var f=$("#productKey").val();a(f)});$("#findHelper").click(function(){var f=$("#productKey2").val();a(f)});function a(f){if(f&&$.trim(f)){f=$.trim(f);window.open(window.basePath+"/mall.html?keyWord="+f)}else{window.open(window.basePath+"/mall.html")}}$(".ref-btn").click(function(){var f=this;clearInterval(e);e=setTimeout(function(){$(f).closest(".recentprice").find(".offer").load(window.basePath+"/refFirstFloorInfo.html");$(f).next().show();setTimeout(function(){$(f).next().hide()},2000)},200)})});