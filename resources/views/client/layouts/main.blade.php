<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Trường Khoa học liên ngành và Nghệ thuật là 1 trong 21 đơn vị đào tạo trực thuộc Đại học Quốc gia Hà Nội với hơn 22 năm kinh nghiệm trong đào tạo, nghiên cứu các chương trình khoa học có tính liên ngành, sáng tạo và nghệ thuật.">
    <meta name="keywords" content="Trường Khoa học liên ngành và Nghệ thuật,Đại học Quốc gia Hà Nội, Khoa học liên ngành, Nghệ thuật, Trường liên ngành, Trường Nghệ thuật">
    @yield('meta')
    <title>@yield('title') | Đại học Quốc gia Hà Nội</title>
    <link rel="Shortcut Icon" type="image/x-icon" href="{{ asset('images/VNU-SIS-logo.png') }}" />
    <!-- Google Font Open Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" />
    <!-- Fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome-free-5.15.4-web/css/all.min.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link href="{{ asset('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet"> --}}
    <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/client/style.css') }}" />
    @yield('css')
</head>

<body>
    {{-- <div class="main"> --}}
        @include('client.layouts.header')

        <div class="container" style="margin-bottom: 30px; min-height: 65vh;">
            @yield('content')
        </div>

        @include('client.layouts.footer')
    {{-- </div> --}}
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "449344552110700");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-197334931-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-197334931-1');
</script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v13.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script> --}}
    @yield('js')
    <script>
        $(document).ready(function(){
            $('.dropdown-submenu, .dropdown').mouseout(function (e) {
                if ($(window).width() >= 1200) {
                    $(this).children('ul').removeClass('show');
                }
            });
            $('.dropdown-submenu, .dropdown').mouseover(function (e) {
                if ($(window).width() >= 1200) {
                    $(this).children('ul').addClass('show');
                }
            });
        });
    </script>
</body>

</html>