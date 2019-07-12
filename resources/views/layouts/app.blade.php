<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mohammed Tariq">
    <title>Contacts</title>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!------ Include all css and inside this comment ----------> 
  </head>

<body>
  	@include('includes.header')
    <div class="container">    
      @yield('content')
    </div>
    @include('includes.footer')
    @yield('scripts')
</body>
</html>

  
	