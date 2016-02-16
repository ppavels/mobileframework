<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuNav
 *
 * @author alekk
 */
class MenuNav {

    private $menuSettings;

    function __construct($menuSettings) {
        $this->menuSettings = $menuSettings;
    }

    public function getMenu() {
        $output = "<div id='left-menu'>
                 <div class='search'>
                 <form action='".SITE_ROOT."' method='GET' >
                    <input name='s'  placeholder='Search...' />
                </form>
                </div>";
        $output.="<div class='wrapmenu'>
            <ul class='menu'>" . PHP_EOL;
            $output.= "<li><a href='".SITE_ROOT."'><i class='fl menu-list'></i><span>Home</span></a></li>" . PHP_EOL;
        
        $output.= "</ul>
                   <h3>Categories</h3>
                   <ul class='menu'>" . PHP_EOL;
        foreach ($this->menuSettings['category'] as $menu) {
            $class = isset($menu["class"])?$menu["class"]:'';
            $output.= "<li><a href='" . $menu['link'] . "' class='" . $class . "'><i class='fl menu-list'></i><span>" . $menu['title'] . "</span></a></li>" . PHP_EOL;
        }
        $output.= "</ul>
                    </div>
                    </div>";

        return $output;
    }

    public function swiper() {
        $output = '<script type="text/javascript">
        document.addEventListener("DOMContentLoaded", doSwipe, false);

        function doSwipe(){
            (function($){
                $(".white-block").swipe({
                    tap:function(event, direction, distance, duration, fingerCount) {
                        if($(".t402-elided").length <= 0){
                            if($(".hyperlink-img").attr("href").length > 0)
                                window.open ( $(".hyperlink-img").attr("href"));
                        }
                    },
                    swipeLeft:function(event, direction, distance, duration, fingerCount) {
                        if(TriggerClick == 0)
                            window.location.href = $(".nav-prev a").attr("href");
                    },
                    swipeRight:function(event, direction, distance, duration, fingerCount) {
                        if(TriggerClick == 0)
                            window.location.href = $(".nav-next a").attr("href");
                    }
                },".swipe-img, .head");

                $(".hyperlink").click(function(e){
                    if($(".t402-elided").length > 0)
                         e.preventDefault();
                });
            })(jQuery);
            }
        </script>';
        return $output;
    }
}

?>
