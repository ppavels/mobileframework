;$(document).ready(function() {
       
    $('.ga_index').click(function(event) {
        var network=this.rel;
        var url = this.href;
        var page_url = url.split('=')[1];
        page_url = page_url.split('&')[0];

        ga('send', 'event', 'social shares', network, page_url);
    });

    $('.ga_mail').click(function(event) {
        var network=this.rel;
        var url = $('.ga_index').attr('href');
        var page_url = url.split('=')[1];
        page_url = page_url.split('&')[0];
        ga('send', 'event', 'social shares', network, page_url);
    });

    $('.ga_title').click(function(event) {
        var url = this.href;
        ga('send', 'event', 'outbound links', 'click on headline', url);
    });
    
        $('.ga_image').click(function(event) {
        var url = $('.ga_title').attr('href');
        ga('send', 'event', 'outbound links', 'click on image', url);
   
    });
  
});

