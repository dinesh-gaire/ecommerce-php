<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/about_us.css?v=<?php echo time(); ?>">
</head>

<body class="body-prop">
    <?php require 'partials/_nav.php'?>

    <div class="container mt-5 bg-dark padded-container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="text-center mb-4">About Us</h1>
                <p>
                    Welcome to <strong>Music Masti</strong>, where the love for music converges with the convenience of online
                    shopping. At our core, we are passionate about providing musicians, both aspiring and seasoned,
                    with top-notch musical instruments that inspire creativity and enhance musical experiences.
                </p>

                <p>
                    <strong>Music Masti</strong> was founded with the belief that every musician deserves access to
                    high-quality instruments that resonate with their unique style. Our commitment to quality extends
                    throughout our carefully curated selection of guitars, pianos, drums, brass instruments, and more.
                </p>

                <p>
                    Our team consists of dedicated music enthusiasts who understand the importance of finding the
                    perfect instrument. We are not just a store; we are a community of musicians, ready to assist you
                    in your musical journey.
                </p>

                <p>
                    Explore our website to discover a world of musical possibilities. Whether you're a beginner or a
                    professional, we have the instruments and accessories to complement your musical endeavors.
                </p>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column justify-content-end">
        <?php require 'partials/_footer.php'; ?>
    </div>
</body>

</html>
