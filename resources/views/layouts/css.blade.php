<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="author" content="{{setting()->name()}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{$setting->name()}}-@yield('title')</title>
@yield("seo")

<meta charset="utf-8">
<link rel="shortcut icon" href="{{$path.$setting->fav}}">

<script src="{{$path}}files/home/head.js"></script>
<link href="https://fonts.googleapis.com/css?family=Work+Sans:200,300,400,500,600,700,800,900&amp;display=swap"
      rel="stylesheet">
<link rel="stylesheet" href="{{$path}}files/home/vendors/font-awesome/css/fontawesome.css">
<link rel="stylesheet" href="{{$path}}files/home/vendors/magnific-popup/magnific-popup.css">
<link rel="stylesheet" href="{{$path}}files/home/vendors/slick/slick.css">
<link rel="stylesheet" href="{{$path}}files/home/vendors/animate.css">

<!-- ar -->
@if(app()->getLocale() == "ar")
    <link rel="stylesheet" type="text/css" href="{{$path}}files/home/ar.css"/>
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <style>
        html, * {
            font-family: 'Tajawal', 'arial';
        }

        .img_flag {
            margin-left: 5px;
        }

        .header-customize-item a .fa {
            margin-left: 5px;
        }
        .slick-slider{
        direction: ltr;
            
        }
    </style>
@else
    <link rel="stylesheet" href="{{$path}}files/home/style.css">
    <style>
        .img_flag {
            margin-right: 5px;
        }

        .header-customize-item a .fa {
            margin-right: 5px;
        }
    </style>
@endif

<!-- Your custom styles (optional) -->
<link rel="stylesheet" href="{{$path}}css/toastr.min.css">
<link rel="stylesheet" href="{{$path}}nprogress-master/nprogress.css"/>
<style>
    .toast, #toast-container {
        z-index: 9999999999999999;
    }

    #staticBackdrop {
        z-index: 99999999999999;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-image: url("{{setting()->bunner()}}");
    }

    .img_flag {
        width: 25px;
        height: 18px;
    }

    #staticBackdrop {
        z-index: 99999999999999;
    }

    .blog_img {
        height: 300px;
    }

    .fe_1_img {
        height: 150px;
    }

    .fe_2_img {
        height: 250px;
    }

    /***** whatsapp ********/
    #whatsapp {
        position: fixed;
        bottom: 160px;
        right: 30px;
        z-index: 99;
    }

    #whatsapp a {
        display: block;
        background: #04d894;
        color: #fff;
        font-size: 25px;
        width: 50px;
        height: 50px;
        text-align: center;
        line-height: 50px;
        border-radius: 50%;
        overflow: hidden;
        position: relative;
    }

    #whatsapp .light {
        width: 70px;
        height: 70px;
        position: absolute;
        background: #8ef9d6;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        z-index: -1;
        -webkit-animation: lightning 1.5s linear infinite;
        animation: lightning 1.5s linear infinite;
    }
</style>
