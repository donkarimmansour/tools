$(function () {

    if (window.location.href.includes("blog/")) {
        $("header .search").addClass("hidden")
        $("header .blog").removeClass("hidden")
        $("header .perks").addClass("hidden")
        $("header ul.nav-perks").addClass("hidden")
        $("header ul.nav-blog").removeClass("hidden")
    } else {
        $("header .search").removeClass("hidden")
        $("header .blog").addClass("hidden")
        $("header .perks").removeClass("hidden")
        $("header ul.nav-perks").removeClass("hidden")
        $("header ul.nav-blog").addClass("hidden")
    }


    $("body > header > nav").each(function () {
    
        let a = $(this).find("a") ;
        a.each(function () {
            if (window.location.href.includes($(this).attr("href"))) {
                $(this).addClass("selected");
            } else {
                $(this).removeClass("selected");
            }
        });


        $(this).hover(
            function () {
                $(this).addClass("active");
            },
            function () {
                $(this).removeClass("active");
            }
        );

      
    });

    $(".menu-icon-container").on("click", function () {
        if ($(".menu-icon-container").attr("aria-expanded") == "true") {
            $(".menu-icon-container").attr("aria-expanded", "false")
            $("header nav.menu").addClass("hidden").addClass("notactive").removeClass("active")

        } else {
            $(".menu-icon-container").attr("aria-expanded", "true")
            $("header nav.menu").removeClass("hidden").removeClass("notactive").addClass("active")
        }

    });

    $("header .secondary button.back").on("click", function () {
        $(this).parent().parent("ul").removeClass("menu-active")
        $(this).parents(".secondary").removeClass("menu-active")
        $("header ul.tertiary").removeClass("menu-hide")
        $(this).focus();
    });

    $("header .secondary button.sub-menu-button").on("click", function () {
        $(this).next("ul").removeClass("menu-hide").addClass("menu-active");
        $(this).parent().parent(".secondary").removeClass("menu-hide").addClass("menu-active");
       $("header ul.tertiary").removeClass("menu-active").addClass("menu-hide")
        $(this).focus();
    });


    $("header .tertiary button.back").on("click", function () {
        $(this).parent().parent("ul").removeClass("menu-active")
        $(this).parents(".tertiary").removeClass("menu-active")
        $("header ul.secondary").removeClass("menu-hide")
        $(this).focus();
    });

    $("header .tertiary  button.sub-menu-button").on("click", function () {
        $(this).next("ul").removeClass("menu-hide").addClass("menu-active");
        $(this).parent().parent(".tertiary").removeClass("menu-hide").addClass("menu-active");
        $("header ul.secondary").removeClass("menu-active").addClass("menu-hide")
        $(this).focus();
    });

    $("header .catcher").on("click", function () {
        if ($(".menu-icon-container").attr("aria-expanded") == "true") {
            $(".menu-icon-container").attr("aria-expanded", "false")
            $("header nav.menu").addClass("hidden").addClass("notactive").removeClass("active")
        }
    });

    
    $("header .search .search-icon ,header .search .search-close").on("click", function () {
        if ($("header .search .search-close").hasClass("hidden")) {
            $("header .search .search-close").removeClass("hidden")
            $("header .search .searchOverlay").removeClass("hidden")
            $("header .search .search-icon").addClass("hidden")  
            $("header .search").addClass("expanded")  
          if( $(window).innerWidth() <= 770) $("header .menu-icon-container").addClass("hidden") 
          $("header .search #search-focus").focus()       
        }else{
            $("header .search .search-close").addClass("hidden")
            $("header .search .searchOverlay").addClass("hidden")
            $("header .search .search-icon").removeClass("hidden")  
            $("header .search").removeClass("expanded")  
            if( $(window).innerWidth() <= 770) $("header .menu-icon-container").removeClass("hidden")
        }
       
    });

       
    $("header .search #search-focus").on("focus", function () {
        if ($("header .search .search-close").hasClass("hidden")) {
            $("header .search .search-close").removeClass("hidden")
            $("header .search .searchOverlay").removeClass("hidden")
            $("header .search .search-icon").addClass("hidden")  
            $("header .search").addClass("expanded")  
            if( $(window).innerWidth() <= 770) $("header .menu-icon-container").addClass("hidden")
        }     
    });

    $("header .search #search-focus").on("blur", function () {
        if (!$("header .search .search-close").hasClass("hidden")) {
            $("header .search .search-close").addClass("hidden")
            $("header .search .searchOverlay").addClass("hidden")
            $("header .search .search-icon").removeClass("hidden")  
            $("header .search").removeClass("expanded")  
            if( $(window).innerWidth() <= 770) $("header .menu-icon-container").removeClass("hidden")
        }
    });

  
});