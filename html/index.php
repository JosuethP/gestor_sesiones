<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php"); // Si no hay sesion, nos redirige
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>HomeCare</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!-- owl stylesheets -->
   <link rel="stylesheet" href="css/owl.carousel.min.css">
   <link rel="stylesheet" href="css/owl.theme.default.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
</head>

<body>
   <!-- header section start -->
   <div class="header_section">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="">Health</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="">Medicine</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="">News</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="">Client</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="">Contact Us</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#"><img src="images/search-icon.png"></a>
               </li>
            </ul>
         </div>
      </nav>
      <!-- header section end -->
      <!-- banner section start -->
      <div id="main_slider" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="banner_section">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-6">
                           <h1 class="banner_taital">Bienvenido, <br><span style="color: #151515;"><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>!</span></h1>
                           <h1> </h1>
                           <p class="banner_text">Has logrado iniciar sesion en el sitio web!!</p>
                           <div class="btn_main">
                              <div class="more_bt"><a href="../cerrar_sesion.php#">Cerrar Sesion</a></div>
                     
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="image_1"><img src="images/llave.png"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
                      
         </div>
         
      </div>
   </div>
   

</body>

</html>