<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css'/>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'/>
</head>
<body>
    {{-- nav bar --}}
    <nav class="navbar navbar-expand-sm bg-light justify-content-center">
        <ul class="navbar-nav ">
          <li class="nav-item"><a href="/" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="/todo/active" class="nav-link">Active</a></li>
          <li class="nav-item"><a href="/todo/done" class="nav-link">Done</a></li>
          <li class="nav-item"><a href="/todo/delete" class="nav-link">Deleted</a></li>
        </ul>
    </nav>    
    @include('layouts.form-new-todo')

    
    @yield('content')


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js'></script>
    <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
</body>
</html>