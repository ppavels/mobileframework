$(document).ready(function() {
    
    /* var path = $(location).attr('pathname');
    if( navigator.userAgent.match(/Android/i)){
    if (!$.cookie('red_pg_shown')) {
        if (!$.cookie('red_pg_shown_times') || $.cookie('red_pg_shown_times') < 10) {
            if (!$.cookie('red_pg_skip') && !$.cookie('red_pg_android')) {
                window.location.href = 'http://' + window.location.hostname + '/app/download-app.php?' + window.location.href;
            }
        }
    }
     }
     */
     
    $(window).scroll(function() {
        if ($(this).scrollTop() != 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        } if ($(this).scrollTop() > 100) {
            $(".logo_single, .logo").css("display", "none");
            $(".scroll_header").fadeIn(200)
        } else {
            $(".logo_single, .logo").css("display", "block");
            $(".scroll_header").css("display", "none")
        }
    });
    //close menu on swipe
    var $swipeToggle = $("#container");
    $("#left-menu").swipe({
        tap:function(event, target) {
            if($(target).is('a')) target.click();
            if($(target).is('input')) target.focus();
        },
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            if (TriggerClick == 1) $("a#menu").trigger("click");
        },
        excludedElements: ""
    });
    $swipeToggle.swipe({
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            if (TriggerClick == 1) $("a#menu").trigger("click");
        },
        excludedElements: ""
    });
    $swipeToggle.swipe("disable");

    TriggerClick = 0;
    $("a#menu").click(function() {
        if (TriggerClick == 0) {
            TriggerClick = 1;
            $("#content-wrapper").height($(window).height());
            $("#content-wrapper section").height($(window).height() - 50);
            $("body").addClass("open-menu");
            $("#content-wrapper,#content-wrapper > div.g-ads-move").animate({
                marginLeft: "75%"
            }, 200);
            $(window).resize(function() {
                $("body").height($(window).height())
                $("#content-wrapper").width($(window).width());
            });
            $(window).trigger("resize");
            $swipeToggle.swipe("enable");
        } else {
            TriggerClick = 0;
            $("#content-wrapper,#content-wrapper > div.g-ads-move").animate({
                marginLeft: "0%"
            }, 200, function(){
                $("body").removeClass("open-menu");
            });
            $(window).resize(function() {
                $("#content-wrapper").height("auto");
                $("#content-wrapper section").height("auto");
                $("body").height("auto");
            });
            $(window).trigger("resize");
            $swipeToggle.swipe("disable");
        }
        return false
    });
    $(".open-menu #content-wrapper").click(function() {
        $("body").removeClass("open-menu");
        $(this).animate({
            marginLeft: "0%"
        }, 200)
    });
    $(".share").click(function() {
        $(this).parents(".white-block").css("background", "#fff");
        $(this).css("display", "none");
        $(this).siblings(".primary-shares").css("display", "inline-block")
    });
    $('#toTop').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 800);
    });
    $(".social-add").click(function() {
        $(this).parent(".primary-shares").css("display", "none");
        $(this).parent(".primary-shares").next(".secondary-shares").css("display", "inline-block")
    });
    $(".close-small").click(function() {
        $(".secondary-shares").css("display", "none");
        $(".share").css("display", "block");
        $(".white-block").css("background", "#fff url(../../public/img/share-arrow.png) no-repeat left bottom")
    });
    $(window).resize(function() {
        $(".wrapmenu").height($(window).height() - 50)
    });
    $(window).trigger("resize");
    
    
    $(".popup").click(function(e) {
        var u_id = getUid();
        var network = this.rel.charAt(0).toUpperCase() + this.rel.slice(1);
        var p_id = $(this).attr('id').replace(this.rel + '-', '');
        var n = 575,
            r = 400,
            i = ($(window).width() - n) / 2,
            s = ($(window).height() - r) / 2,
            url = this.href,
            u = "status=1" + ",width=" + n + ",height=" + r + ",top=" + s + ",left=" + i;
        window.open(url, "", u);
        data = {'shareurl': url,'sn': network, 'action': 'sharesave', 'u_id': u_id, 'p_id': p_id, 'url': 'send/ajax'};
        saveData(data, ajax_url);
        
        return false
    });
    
     //new API starts//
    //setting cookie for new user//
    function randomNumberFromRange(max)
    {
        return(Math.floor(Math.random()*(max)));
    }

    function setUid(){
        if( !$.cookie('___uid'))  {
            $.cookie("___uid", randomNumberFromRange(1000000000), { path    : '/', expires : 365 });

        }
    }
    function getUrl(){
        return window.location.href;
    }

    function getUid(){
        if($.cookie('___uid')) {
            return $.cookie('___uid');
        }
        else{
            var rndm = randomNumberFromRange(1000000000);
            $.cookie("___uid", rndm, { path    : '/', expires : 365 });
            return rndm;
        }
    }
    function saveData(data, ajax_url){
        $.ajax({
            url: ajax_url,
            data: data,
            success: function(e) {
                console.log('response: '+e);},
            error: function(e) {
                 //action: 'tracking_action',
                //param:  JSON.stringify(data)
            }
        });
        return false;
    }
    function saveClick(ajax_url){
        //this is click tracking
        $('.clickshares').click(function(event) {

                    var u_id = getUid();
                    var u_rl = getUrl();
                    if($(this).attr('id')){
                        var placer = ($(this).attr('id')).split('-',2);
                        var place = placer[0];
                        var p_id = placer[1];
                    }
                    else if($('#trackpost').lenth){
                        var p_id  = $('#trackpost').attr("value");
                        var place = 'undefined';

                    }
                    else{
                        var p_id  = 'undefined';
                        var place = 'undefined';
                    }

                data = {'posturl': u_rl, 'action': 'clicksave', 'uid': u_id, 'pid': p_id, 'place':place, 'url': 'send/ajax'};
                saveData(data, ajax_url);

        });
    }
    function saveView(ajax_url){

               //this is views tracking
               if($("#trackpost").length) {

                if($("#trackpost").attr('value')){

                    var u_id = getUid();
                    var u_rl = getUrl();
                    var p_id  = $('#trackpost').attr("value");



                }else {
                    var u_id = getUid();
                    var u_rl = getUrl();
                    var p_id  = 'undefined';
                }


                data = {'posturl': u_rl, 'action': 'viewsave', 'uid': u_id, 'pid': p_id,  'url': 'send/ajax'};
                saveData(data, ajax_url);




        }
    }
    setUid();
    saveClick(ajax_url);
    saveView(ajax_url);
    //new API ends//

     /* POST Gallery Slideshow Scripts */
    var currentSlide = getUrlVars()['slide'];
    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    //var sliderUlWidth = slideCount * slideWidth;

    if(getUrlVars()['slide'] == null){
        var currentSlide = 1;
    }else{
        var currentSlide = getUrlVars()['slide'];
    }
    //console.log(currentSlide);

    $('#slider').css({ width: slideWidth, height: slideHeight });
    //$('#slider ul').css({ width: sliderUlWidth });
    $('li.slide'+currentSlide).css("display","block");

    if(currentSlide == 1 ){
        $('.control_prev').css("display", "none");
    }
    if(currentSlide == slideCount){
        $('.control_next').css("display", "none");
    }

    $('a.control_prev').click(function (e) {
        currentSlide--;
        insertParam('slide', currentSlide );
        e.preventDefault();
    });

    $('a.control_next').click(function (e) {
        currentSlide++;
        insertParam('slide', currentSlide )
        e.preventDefault();
    });

    function insertParam(key, value)
    {
        key = encodeURI(key); value = encodeURI(value);

        var kvp = document.location.search.substr(1).split('&');

        var i=kvp.length; var x; while(i--) 
        {
            x = kvp[i].split('=');

            if (x[0]==key)
            {
                x[1] = value;
                kvp[i] = x.join('=');
                break;
            }
        }

        if(i<0) {kvp[kvp.length] = [key,value].join('=');}

        //this will reload the page, it's likely better to store this until finished
        document.location.search = kvp.join('&'); 
    }

    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    
});