intervId=setInterval(DeleteGoogleIframe, 500)
function DeleteGoogleIframe()
{
    $("a.lbox").lightBox();
    if($("iframe").length)
    {
        $("iframe").load(function()
        {
            setTimeout(function()
            {
                $("iframe").hide();
                if($("body").css("top")=="40px"){
                    $("body").css("margin-top", "-40px");
                    clearInterval(intervId);
                }                
            }, 250);
        });
        
    }
    
}
$(document).ready(function(){    
    $(".bottom-news").click(function(){                
        if($(this).hasClass("active")){
            $(this).parent("div").children(".news-content").animate({
                height : 93
            }, {
                queue : false, 
                duration: 500
            });   
            $(this).children(".label-arrow-news").html("Читать далее");
            $(this).removeClass("active");
        } else {
            $(this).parent("div").children(".news-content").animate({
                height : $(this).parent("div").children(".news-content").children(".news-test").height()
            }, {
                queue : false, 
                duration: 500
            });   
            $(this).children(".label-arrow-news").html("Свернуть");
            $(this).addClass("active");
        }
    })
    $(".open-modal").click(function(){
        $(this).addClass("active");
        $(this).children(".modal-windows-wrap").show();
        $(this).children(".modal-windows-wrap").prependTo(".content-text");     
        $("body").prepend("<div class='modal_bg'></div>");
    })
    $(".close-modal").click(function(){
        $(this).parent("div").parent(".modal-windows-wrap").hide();
        $(this).parent("div").parent(".modal-windows-wrap").appendTo(".open-modal.active");
        $(".open-modal.active").removeClass("active");
        $(".modal_bg").remove();
    })
})