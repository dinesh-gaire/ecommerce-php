<?php
$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true;

$navbarContent = '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/ecomweb/">
            <div class="d-flex flex-row justify-content-start">
                <img src="https://i.imgur.com/RV41OkU.png" height="45px">
                <div class="d-flex flex-column justify-content-end">
                    <h5 class="nav-title">Music Masti</h5>
                </div>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/ecomweb/welcome.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/ecomweb/about_us.php">About Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/ecomweb/contact_us.php">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/ecomweb/services.php">Services</a>
                </li>
                ';

if (!$loggedin) {
    $navbarContent .= '
                <li class="nav-item">
                    <a class="nav-link" href="/ecomweb/login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ecomweb/signup.php">Sign Up</a>
                </li>';
}

if ($loggedin) {
    $navbarContent .= '
                <li class="nav-item">
                    <a class="nav-link" href="/ecomweb/your_orders.php">Your Orders</a>
                </li>
            </ul>
            <button onclick="openCart()" class="nav-btn d-flex">
                <img src="https://i.imgur.com/T8pAlYu.png" height="30px">
                <div class="d-flex flex-column justify-content-center">
                    <strong>';
    $navbarContent .= isset($_SESSION['count']) ? $_SESSION['count'] : 0;
    $navbarContent .= '</strong>
                </div>
            </button>
            <div class="dropdown">
                <button class="nav-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="d-flex align-items-center dropdown-toggle">
                        <img src="https://cdn-icons-png.flaticon.com/512/9131/9131529.png" height="30px" class="user-img">
                        <div class="d-flex flex-column justify-content-center">
                            <strong>';
    $navbarContent .= $_SESSION['Name'];
    $navbarContent .= '</strong>
                        </div>
                    </div>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="/ecomweb/logout.php">Logout</a></li>
                </ul>
            </div>
        ';
}
$navbarContent .= '</div>
    </div>
</nav>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Bree+Serif&family=Caveat:wght@400;700&family=Lobster&family=Monoton&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display+SC:ital,wght@0,400;0,700;1,700&family=Playfair+Display:ital,wght@0,400;0,700;1,700&family=Roboto:ital,wght@0,400;0,700;1,400;1,700&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,700&family=Work+Sans:ital,wght@0,400;0,700;1,700&display=swap");
      .navbar {
          padding: 15px;
          color: #fff;
      }

      .user {
          border: #C3C4C5 2px solid;
          border-radius: 8px;
          padding: 8px;
      }

      img {
          margin-right: 8px;
      }

      h5 {
          font-size: 28px;
      }

      .nav-btn {
          border: #C3C4C5 2px solid;
          border-radius: 8px;
          padding: 8px;
          color: #fff;
          margin: 20px;
          margin-top: 0;
          margin-bottom: 0;
          font-weight: bold;
          background-color: transparent;
      }

      .nav-btn:hover {
          background-color: #ffffff31;
      }

      .nav-title{
        font-family: "Bree Serif";
      }

      .user-img {
          margin-right: 10px; 
      }

  </style>
    <?php echo $navbarContent; ?>
</head>

<body>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var path = window.location.pathname;

            var page = path.split("/").pop();

            var activeNavItem = document.querySelector('a[href="/ecomweb/' + page + '"]');

            if (activeNavItem) {
                activeNavItem.classList.add('active');
            }
        });

        function openCart() {
            window.location.assign('cart.php');
        }
    </script>

</body>

</html>
