$(document).foundation();
  $(window).load(function() {
      $('#slider').nivoSlider({
        effect: 'fade',
        controlNav: false,
        pauseOnHover: false
      });
  });
  var map;
  $(document).ready(function() {
    map = new GMaps({
        el: '#map',
        lat: 27.668104,
        lng: 85.309239,
        zoomControl : true,
        zoomControlOpt: {
            style : 'SMALL',
            position: 'TOP_LEFT'
        },
        panControl : false,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false
    });
    map.addMarker({
      lat: 27.668104,
      lng: 85.309239,
      title: 'The Buddha Eye Tours & Travels Pvt. Ltd.',
      click: function(e){
        alert('You clicked in this marker');
      }
    });
  });
      $(document).ready(function(){
        $('.exc-slider').bxSlider({
          slideWidth: 300,
          minSlides: 2,
          maxSlides: 3,
          moveSlides: 1,
          slideMargin: 10
        });
      });
  function changenep() {
    $('#nep').show();
    $('#ind').hide();
  }
  function changeind() {
    $('#nep').hide();
    $('#ind').show();
  }
  function changeOne() {
    $('#final').show();
    $('#dfinal').hide();
  }
  function changeRound() {
    $('#final').hide();
    $('#dfinal').show();
  }
  function hdriver() {
    $('#driver').hide();
  }
  function sdriver() {
    $('#driver').show();
  }