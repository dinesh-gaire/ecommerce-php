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
    <link rel="stylesheet" href="styles/services.css?v=<?php echo time(); ?>">
</head>

<body class="body-prop">
    <?php require 'partials/_nav.php'?>

    <div class="container mt-5 bg-dark padded-container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="text-center mb-4">Our Services</h1>
                <p>
                    At <strong>Music Masti</strong>, we are dedicated to providing a comprehensive range of services to enhance
                    your musical journey. Our commitment goes beyond selling instruments; we aim to support and
                    inspire musicians at every step. Explore our services below: <br><br>
                </p>

                <h4 class="mt-4">1. Wide Range of Instruments</h4>
                <p class="indent">
                    Discover an extensive collection of musical instruments, carefully curated for all skill levels and
                    musical genres. From guitars and pianos to drums and brass instruments, we have everything you
                    need to express your musical creativity.
                </p>

                <h4 class="mt-4">2. Quality Assurance</h4>
                <p class="indent">
                    We prioritize quality in every product we offer. Each instrument undergoes rigorous testing to
                    ensure it meets the highest standards of craftsmanship and performance. Our commitment to quality
                    ensures that you receive a reliable and exceptional instrument every time.
                </p>

                <h4 class="mt-4">3. Educational Resources</h4>
                <p class="indent">
                    Empower yourself with our valuable educational resources. Access buying guides, tutorials, and tips
                    from experienced musicians. We believe that learning and growing as a musician is a continuous
                    journey, and we're here to support you every step of the way.
                </p>

                <h4 class="mt-4">4. Customer Support</h4>
                <p class="indent">
                    Our dedicated customer support team is here to assist you with any questions or concerns. Whether
                    you need advice on choosing the right instrument or assistance with your order, we're just a
                    message away.
                </p>

                <h4 class="mt-4">5. Secure and Convenient Shopping</h4>
                <p class="indent">
                    Enjoy a seamless online shopping experience with our secure and user-friendly platform. We prioritize
                    your privacy and security, ensuring that your transactions are protected. Focus on the music while we
                    take care of the rest.
                </p>

                <h4 class="mt-4">6. Fast and Reliable Shipping</h4>
                <p class="indent">
                    We understand that you want to start playing as soon as possible. That's why we offer fast and
                    reliable shipping options to get your musical treasure to your doorstep promptly.
                </p>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column justify-content-end">
        <?php require 'partials/_footer.php'; ?>
    </div>
</body>

</html>
