<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="{{asset('/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script src="{{asset('/js/resource_js_preloader.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
<!--  Google Maps Plugin    -->
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="{{asset('/js/material-kit.js?v=2.0.7')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" type="text/javascript"></script>



<script>
  $(document).ready(function() {
    //init DateTimePickers
    materialKit.initFormExtendedDatetimepickers();

    // Sliders Init
    materialKit.initSliders();
  });


  function scrollToDownload() {
    if ($('.section-download').length != 0) {
      $("html, body").animate({
        scrollTop: $('.section-download').offset().top
      }, 1000);
    }
  }

</script>

<script>
    // $("#slider").owlCarousel({
    //     autoplaySpeed:1000,
    //     autoplayTimeout: 5000,
    //     loop:true,
    //     margin:10,
    //     autoplay:true,
    //     autoplayHoverPause:true,
    //     items : 4,
    // });

    $('#slider').owlCarousel({
    autoplaySpeed:1000,
    autoplayTimeout: 5000,
    loop:true,
    margin:10,
    autoplay:true,
    autoplayHoverPause:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false,
            loop:true
        },
        600:{
            items:3,
            nav:false,
            loop:true
        },
        1000:{
            items:4,
            nav:false,
            loop:true
        }
    }
})
</script>
@if (Session::has('success'))
    <script>
        toastr.success("{!!Session::get('success')!!}")
    </script>
@elseif (Session::has('error'))
    <script>
        toastr.error("{!!Session::get('error')!!}")
    </script>
@endif
