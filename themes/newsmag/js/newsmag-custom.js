jQuery(function($){



    
    $('.page-loader').delay(500).fadeOut(500);



    

    if($(window).width()>768){

        $('.nav li').hover(function(){

        $(this).find('ul').stop().slideToggle(150);        

        });


        $('.primary-navigation ul').find('ul').hover(function(){

            $(this).prev('a').toggleClass('active');

        });

    }




    $('.search-submit').click(function(){

        $('#searchform').submit();

    });




    if($(window).width()<769){

        $('.primary-navigation .nav li ul').css('display','block')

    }

  
    $('.menu-justify-wrap').click(function(){

        $('.fa-align-justify').toggleClass('menu-active');

        $('ul.nav').slideToggle('100');

    });





    $('.featured-category img').hover(function(){

        $(this).stop().fadeTo(150,0.5);

    },function(){

        $(this).stop().fadeTo(150,1);

    });



    
    $('.swipe').slick({
        dots: true,
        infinite: true,
        speed: 300,
        fade: false,
        slide: 'div',
        cssEase: 'linear',
        autoplay : true,
        autoplaySpeed: 4000
    });




    $('.category-mixed').each(function(){

        $(this).find('ul li:gt(0) img').css({

            width:'60px',
            height:'60px',
            float:'left',
            marginRight:'1em',

        });


        $(this).find('ul li:gt(0) article').css('marginBottom','2em');

        $(this).find('ul li:gt(0) .entry-summary').css('display','none');



        $(this).find('ul li:first img').hover(function(){

            $(this).addClass('scale');
            $(this).removeClass('scale-two');

        },function(){

            $(this).addClass('scale-two');
            $(this).removeClass('scale');

        });

    });




    $('.category-mixed-blog').find('ul li img').hover(function(){

        $(this).addClass('scale');
        $(this).removeClass('scale-two');

    },function(){

        $(this).addClass('scale-two');
            $(this).removeClass('scale');

    });


    $('.category-wide .entry-media').find('img').hover(function(){

        $(this).addClass('scale');

        $(this).removeClass('scale-two');

    },function(){

        $(this).addClass('scale-two');

        $(this).removeClass('scale');

    });
    


    $('.category-mixed').each(function(){

        $(this).find('ul li:first .entry-content a').css('overflow','hidden');
        
    });





   $(window).scroll(function(){

        if($(this).scrollTop()> 1000){
            $('.go-top-button').stop().fadeIn();
        }else{
            $('.go-top-button').stop().fadeOut();
        }

   });



   $('.go-top-button').click(function(){

        $('body').animate({scrollTop:0},500);

   });


    $(".content-main").fitVids();



    $('.rsswidget').parent('h3').css('paddingLeft','10px');





})





/************************************************************************
// Google Map
*************************************************************************/
jQuery(function($) { 

function render_map( $el ) {
 
    // var
    var $markers = $el.find('.marker');
 
    // vars
    var args = {
        zoom        : 16,
        center      : new google.maps.LatLng(0, 0),
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
        streetViewControl:false,
      draggable:true,
      scrollwheel:false,
      mapTypeControl:false,
      panControl:false,

    };
 
    // create map               
    var map = new google.maps.Map( $el[0], args);
 
    // add a markers reference
    map.markers = [];
 
    // add markers
    $markers.each(function(){
 
        add_marker( $(this), map );
 
    });
 
    // center map
    center_map( map );
 
}

function add_marker( $marker, map ) {
 
    // var
    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
 
    // create marker
    var marker = new google.maps.Marker({
        position    : latlng,
        map         : map
    });
 
    // add to array
    map.markers.push( marker );
 
    // if marker contains HTML, add it to an infoWindow
    if( $marker.html() )
    {
        // create info window
        var infowindow = new google.maps.InfoWindow({
            content     : $marker.html()
        });
 
        // show info window when marker is clicked
        google.maps.event.addListener(marker, 'click', function() {
 
            infowindow.open( map, marker );
 
        });
    }
 
}

function center_map( map ) {
 
    // vars
    var bounds = new google.maps.LatLngBounds();
 
    // loop through all markers and create bounds
    $.each( map.markers, function( i, marker ){
 
        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
 
        bounds.extend( latlng );
 
    });
 
    // only 1 marker?
    if( map.markers.length == 1 )
    {
        // set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( 12 );
    }
    else
    {
        // fit to bounds
        map.fitBounds( bounds );
    }
 
}
 

 
 jQuery(function($){


    $('.acf-map').each(function(){
 
        render_map( $(this) );
 
    });

})
 
});
