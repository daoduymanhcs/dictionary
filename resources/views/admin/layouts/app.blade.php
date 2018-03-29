<!DOCTYPE html>
<!-- saved from url=(0053)https://getbootstrap.com/docs/3.3/examples/dashboard/ -->
<html lang="vi">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="vYVY8hc7l_mLqGMZPTj1ASWPsJnXpNl5u2pxLTrvTG0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="{{ isset($word) ? 'Từ điển có '.count($datas).' ý nghĩa của '.$word.'.Bạn có thể thêm ý nghĩa của từ '.$word : 'Từ điển luôn cập nhật thuật ngữ mới nhất, xu hướng nhất. Bạn có thể giúp đỡ cộng đồng bằng cách thêm từ và ý nghĩa mới.' }}">
    <meta name="author" content="">

    <title>{{ isset($word) ? $word. ' nghĩa là gì' : 'Tra từ nhanh' }}</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    @yield('css')

  </head>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">HOME</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
          <ul class="nav navbar-nav">
<!--             <li class=""><a href="/">Home</a></li>
            <li><a href="#about">About</a></li> -->
            <li><a href="/contact">Liên hệ</a></li>
<!--             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Default</a></li>
            <li class="active"><a href="./">Static top <span class="sr-only">(current)</span></a></li>
            <li><a href="../navbar-fixed-top/">Fixed top</a></li>
          </ul> -->
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container">
      <div class="row">
      @yield('content')
        <!-- ads -->
        <div class="col-md-4">
          <div class="ads" style="margin-top: 20px; margin-bottom: 20px">
            <a href="https://www.facebook.com/photo.php?fbid=10215039801284757&set=a.3170908987940.2150488.1121952694&type=3&theater" target="_blank"><img src="images/khanh.jpeg" class="img-responsive" alt=""></a>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        <span>Website cung cấp thông tin về thuật ngữ miễn phí cho người Việt Nam. Mọi ý kiến đóng góp xin vui lòng liên hệ tại đây!</span>
      </div>
    </footer>
  </body>
    <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  @yield('script')
</html>