<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="/user-public/assets/img/favicon.ico">

    <!-- CSS here -->
        <link rel="stylesheet" href="/user-public/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/user-public/assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="/user-public/assets/css/flaticon.css">
        <link rel="stylesheet" href="/user-public/assets/css/slicknav.css">
        <link rel="stylesheet" href="/user-public/assets/css/animate.min.css">
        <link rel="stylesheet" href="/user-public/assets/css/magnific-popup.css">
        <link rel="stylesheet" href="/user-public/assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="/user-public/assets/css/themify-icons.css">
        <link rel="stylesheet" href="/user-public/assets/css/slick.css">
        <link rel="stylesheet" href="/user-public/assets/css/nice-select.css">
        <link rel="stylesheet" href="/user-public/assets/css/style.css">
    <!-- Main styles for this application-->
    <link href="C:\Users\tranl\Desktop\admin\laravel2\New\public\user-public\assets\css\style.css" rel="stylesheet">
    
  </head>
  <body>
    @include('user.layouts.header')
    @yield('sliderarea')
    @yield('content')
    @include('user.layouts.footer')
  </body>
  @include('user.layouts.scripts')
</html>