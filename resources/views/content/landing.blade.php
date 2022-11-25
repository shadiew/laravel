<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Links -->
  <link rel="icon" type="image/png" href="images/logo/favicon.ico" />
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="landing-page/icofont.min.css">
  <link href="landing-page/css/bootstrap.min.css" rel="stylesheet" />
  <link href="landing-page/css/slick.css" rel="stylesheet" />
  <link href="landing-page/css/main.css" rel="stylesheet" />

  <!-- Metas -->
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Tokofollower" />
  <!-- Primary Meta Tags -->
  <title>Tokofollower: Jual Follower, Subscriber, Like Dan Berbagai Kebutuhan Sosial Media Lainnya.</title>
  <meta name="title" content="Tokofollower: Jual Follower, Subscriber, Like Dan Berbagai Kebutuhan Sosial Media Lainnya.">
  <meta name="description" content="Tokofollower menyediakan kebutuhan follower, subscriber, likes dan berbagai kebutuhan sosial media lainnya. Beli follower, like, dan subscibe disini!">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://tokofollower.com/">
  <meta property="og:title" content="Tokofollower: Jual Follower, Subscriber, Like Dan Berbagai Kebutuhan Sosial Media Lainnya.">
  <meta property="og:description" content="Tokofollower menyediakan kebutuhan follower, subscriber, likes dan berbagai kebutuhan sosial media lainnya. Beli follower, like, dan subscibe disini!">
  <meta property="og:image" content="https://tokofollower.com/images/logo/tokofollower.png">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://tokofollower.com/">
  <meta property="twitter:title" content="Tokofollower: Jual Follower, Subscriber, Like Dan Berbagai Kebutuhan Sosial Media Lainnya.">
  <meta property="twitter:description" content="Tokofollower menyediakan kebutuhan follower, subscriber, likes dan berbagai kebutuhan sosial media lainnya. Beli follower, like, dan subscibe disini!">
  <meta property="twitter:image" content="https://tokofollower.com/images/logo/tokofollower.png">

</head>

<body>
  <!-- HEADER SECTION -->
  <header id="home">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light ">
        <!-- Change Logo Img Here -->
        <a class="navbar-brand" href="#"><img src="images/logo/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <div class="interactive-menu-button">
            <a href="#">
              <span>Menu</span>
            </a>
          </div>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <!-- Nav Link -->
              <a class="nav-link" data-scroll href="#home">Home.<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <!-- Nav Link -->
              <a class="nav-link" data-scroll href="#about-us">Tentang kami.</a>
            </li>
            <li class="nav-item">
              <!-- Nav Link -->
              <a class="nav-link" data-scroll href="#portfolio">Layanan.</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data-scroll href="#blog">Blog.</a>
            </li> -->
            <li class="nav-item">
              <!-- Nav Link -->
              <a class="nav-link" data-scroll href="#contact-us">Hubungi kami.</a>
            </li>
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">EN</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">DE </a>
                <a class="dropdown-item" href="#">ES </a>
              </div>
            </li> -->
          </ul>
          <form id="check" class="contact-btn form-inline my-2 my-lg-0">
            <!-- Contact Us Button -->
            @if(Auth::check())
            <button type="submit" value="dashboard">Dashboard</button>
            @else
            <button type="submit" value="login">Masuk</button>
            @endif
          </form>
        </div>
      </nav>
    </div>
    <!-- HERO SECTION -->
    <div class="container-fluid hero">
      <img src="landing-page/images/hero.svg" alt="">
      <div class="container">
        <!-- Hero Title -->
        <h1>Tambah follower<br>aman & tanpa ribet.</h1>
        <!-- Hero Title Info -->
        <p>Cukup daftar atau login di Tokofollower,<br> lalu deposit saldo dan pilih layanan yang anda butuhkan.</p>
        <div class="hero-btns">
          <!-- Hero Btn First -->
          <a data-scroll href="/register">Daftar</a>
          <!-- Hero Btn Second -->
          @if(Auth::check())
          <a data-scroll href="/dashboard">Dashboard.</a>
          @else
          <a data-scroll href="/login">Masuk.</a>
          @endif
        </div>
      </div>
    </div>
  </header>
  <!-- SERVICES SECTION -->
  <section id="about-us" class="services">
    <div class="container-fluid">
      <div class="side-img">
        <img src="landing-page/images/aside.svg" alt="">
      </div>
      <div class="side2-img">
        <img src="landing-page/images/aside2.svg" alt="">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-12 col-lg-4 service-txt">
            <h2>SeAMAN & seMUDAH belanja di toko online.</h2>
            <div class="hero-btns service-btn">
              <a data-scroll href="/register">Coba sekarang!</a>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="service-box">
              <img src="landing-page/images/service-icon1.svg" alt="">
              <!-- Service Title -->
              <h3>Aman &<br>Rahasia</h3>
              <!-- Replace Patch to Image Under -->
              <p>Kami tidak perlu akses ke akun anda, cukup link atau username saja.</p>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-lg-4">
            <div class="service-box">
              <img src="landing-page/images/service-icon2.svg" alt="">
              <!-- Service Title -->
              <h3>Mudah &<br>Simple</h3>
              <!-- Service Info -->
              <p>Deposit otomatis, tidak perlu konfirmasi admin. Status pembelian juga terbuka dan update.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ABOUT SECTION -->
  <section class="about">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-lg-6">
          <img src="landing-page/images/aboutimg.svg" alt="">
        </div>
        <div class="col-12 col-sm-12 col-lg-6">
          <h5>TENTANG KAMI</h5>
          <h2>Dibangun dari<br>keahlian dan kepercayaan.</h2>
          <p>Kemudahan dan Keamanan adalah dua hal yang kami tawarkan. Topup saldo mudah dan otomatis dengan berbagai channel
            pembayaran seperti Virtual Account dari BCA, BNI, BRI, MANDIRI, Permata Bank, Muamalat, CIMB. Serta channel lain seperti ALFAMART dan QRIS(GoPay, OVO, DANA dll).
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- PORTFOLIO SECTION -->
  <section id="portfolio" class="portfolio">
    <div class="container-fluid">
      <div class="portfolio-aside">
        <img src="landing-page/images/aside3.svg" alt="">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2>Beberapa produk<br>dan layanan kami.</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-4 work-box">
            <div class="photobox photobox_type10">
              <div class="photobox__previewbox">
                <!-- Replace Patch to Image Under -->
                <img src="landing-page/images/instagram.jpg" class="photobox__preview" alt="Preview">
                <!-- Replace Image Title Under -->
                <span class="photobox__label">Instagram Follower, like, comment, impression, dll.</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4 work-box">
            <div class="photobox photobox_type10">
              <div class="photobox__previewbox">
                <!-- Replace Patch to Image Under -->
                <img src="landing-page/images/facebook.jpg" class="photobox__preview" alt="Preview">
                <!-- Replace Image Title Under -->
                <span class="photobox__label">Facebook Pages Like, Follower, Video Views, dll.</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4 work-box">
            <div class="photobox photobox_type10">
              <div class="photobox__previewbox">
                <!-- Replace Patch to Image Under -->
                <img src="landing-page/images/twitter.jpg" class="photobox__preview" alt="Preview">
                <!-- Replace Image Title Under -->
                <span class="photobox__label">Twitter Follower, like, retweet, dll.</span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-4 work-box">
            <div class="photobox photobox_type10">
              <div class="photobox__previewbox">
                <!-- Replace Patch to Image Under -->
                <img src="landing-page/images/tiktok.jpg" class="photobox__preview" alt="Preview">
                <!-- Replace Image Title Under -->
                <span class="photobox__label">Tiktok Follower, Views, Like, Comments, dll.</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4 work-box">
            <div class="photobox photobox_type10">
              <div class="photobox__previewbox">
                <!-- Replace Patch to Image Under -->
                <img src="landing-page/images/youtube.jpg" class="photobox__preview" alt="Preview">
                <!-- Replace Image Title Under -->
                <span class="photobox__label">Youtube Channel Subscriber, Like, Views, Comments, dll.</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-4 work-box">
            <div class="photobox photobox_type10">
              <div class="photobox__previewbox">
                <!-- Replace Patch to Image Under -->
                <img src="landing-page/images/pinterest.jpg" class="photobox__preview" alt="Preview">
                <!-- Replace Image Title Under -->
                <span class="photobox__label">Pinterest follower dll.</span>
              </div>
            </div>
          </div>
        </div>
        <!-- Hidden Images From Portfolio -->
        <div id="hiden-gallery" class="hide">
          <div class="row">
            <div class="col-12 col-lg-4 work-box">
              <div class="photobox photobox_type10">
                <div class="photobox__previewbox">
                  <!-- Replace Patch to Image Under -->
                  <img src="landing-page/images/snapchat.jpg" class="photobox__preview" alt="Preview">
                  <!-- Replace Image Title Under -->
                  <span class="photobox__label">Snapchat</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 work-box">
              <div class="photobox photobox_type10">
                <div class="photobox__previewbox">
                  <!-- Replace Patch to Image Under -->
                  <img src="landing-page/images/linkedin.jpg" class="photobox__preview" alt="Preview">
                  <!-- Replace Image Title Under -->
                  <span class="photobox__label">Linkedin</span>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-4 work-box">
              <div class="photobox photobox_type10">
                <div class="photobox__previewbox">
                  <!-- Replace Patch to Image Under -->
                  <img src="landing-page/images/web.jpg" class="photobox__preview" alt="Preview">
                  <!-- Replace Image Title Under -->
                  <span class="photobox__label">Trafik Website Indonesia, USA, Eropa, dll.</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 more-btn">
            <!-- Show Me More/Less Button -->
            <a class="more-btn-inside">Layanan Lainnya..</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- BLOG SECTION -->
  <!-- <section id="blog" class="blog">
    <div class="container-fluid">
      <div class="blog-aside">
        <img src="landing-page/images/aside4.svg" alt="">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h5>BLOG STORIES</h5>
            <h2>Check Our News</h2>
          </div>
        </div>
        <div id="blog-drag" class="row blog-slider">
          <div class="col-12 col-lg-4 blog-box blog-first">
            <h6>NEW ADVENTURE</h6>
            <p>17 March 2019</p>
            <p>Vestibulum ac diam sit amet quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.</p>
          </div>
          <div class="col-12 col-lg-4 blog-box">
            <h6>NEW ADVENTURE</h6>
            <p>17 March 2019</p>
            <p>Vestibulum ac diam sit amet quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.</p>
          </div>
          <div class="col-12 col-lg-4 blog-box">
            <h6>NEW ADVENTURE</h6>
            <p>17 March 2019</p>
            <p>Vestibulum ac diam sit amet quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.</p>
          </div>
          <div class="col-12 col-lg-4 blog-box hiden-blog hide-blog">
            <h6>NEW ADVENTURE</h6>
            <p>17 March 2019</p>
            <p>Vestibulum ac diam sit amet quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.</p>
          </div>
          <div class="col-12 col-lg-4 blog-box hiden-blog  hide-blog">
            <h6>NEW ADVENTURE</h6>
            <p>17 March 2019</p>
            <p>Vestibulum ac diam sit amet quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.</p>
          </div>
          <div class="col-12 col-lg-4 blog-box hiden-blog  hide-blog">
            <h6>NEW ADVENTURE</h6>
            <p>17 March 2019</p>
            <p>Vestibulum ac diam sit amet quam vehicula elementum amet est on dui. Nulla porttitor accumsan tincidunt.</p>
          </div>
        </div>
        <button class="hide-me" id="blog-btn">Show More Stories</button>
      </div>
    </div>
  </section> -->
  <!-- CONTACT SECTION -->
  <section id="contact-us" class="contact">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Hubungi Kami</h5>
          <h2>Untuk pertanyaan, kerjasama, reseller, dan lainnya.</h2>
        </div>
      </div>
      <form method="post" id="test" name="test" action="{{url('/contact#contact-us')}}">
        @csrf

        @if (count($errors) > 0)
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
        </div>
        @endif

        <div class="row">
          <div class="col-12 col-lg-6 email">
            <input placeholder="Email Anda" type="email" id="email" name="email" pattern=".+@globex.com" size="30" required>
          </div>
          <div class="col-12 col-lg-6 email">
            <input placeholder="Judul Pesan" type="subject" id="subject" name="subject" size="30" required>
          </div>
        </div>
        <div class="row">
          <div class="col-12 message">
            <textarea id="message" name="message" rows="5" cols="1">Isi pesan disini...</textarea>
          </div>
          <div class="col-12">
            <div class="hero-btns contact-btn">
              <!-- Send Message Btn -->
              <a href="javascript:submitFormWithValue('foo')">Kirim</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- FOOTER SECTION -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h5>Tokofollower</h5>
          <h3>Lengkap dan Terpercaya</h3>
          <ul class="contact-nav">
            <li><a data-scroll href="#home">Home.</a></li>
            <li><a data-scroll href="#about-us">Tentang Kami.</a></li>
            <li><a data-scroll href="#portfolio">Layanan.</a></li>
            <!-- <li><a data-scroll href="#blog">Blog.</a></li> -->
            <li><a data-scroll href="#contact-us">Hubungi Kami.</a></li>
          </ul>
          <h6>© {{date('Y')}} - Tokofollower, All Right Reserved</h6>
          <ul class="social">
            <li><a href="https://www.instagram.com/tokofollowerdotcom/" target="_blank"><i class="icofont-instagram"></i></a></li>
            <li><a href="#" target="_blank"><i class="icofont-facebook"></i></a></li>
            <li><a href="#" target="_blank"><i class="icofont-twitter"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="landing-page/js/bootstrap.min.js"></script>
  <script src="landing-page/js/slick.min.js"></script>
  <script src="landing-page/js/smooth-scroll.min.js"></script>
  <script src="landing-page/js/main.js"></script>
  <script>
    function submitFormWithValue(val) {
      // document.getElementById('command').value = val;
      document.forms["test"].submit();
    }
    $(document).ready(function() {
      $(document).on("click", ":submit", function(e) {
        e.preventDefault();
        window.location.href = "/" + $(this).val();
      });
    });
  </script>
  <!-- Scripts Ends -->
</body>

</html>