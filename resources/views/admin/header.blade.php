<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{$title}}</title>



<script src="https://kit.fontawesome.com/ca52985f3f.js" crossorigin="anonymous"></script>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('template/admin/plugins/fontawesome-free/css/all.min.css') }}">
<!-- ichec>k bootstrap -->
<link rel="stylesheet" href="{{asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset('template/admin/dist/css/adminlte.min.css')}}">

<!--dinh nghĩ rieng file Helper-->
<link rel="stylesheet" href="{{asset('template/admin/css/helper.css')}}"> 

<meta name="csrf-token" content="{{ csrf_token() }}">



@yield('header')
  