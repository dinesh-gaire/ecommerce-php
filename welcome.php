<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('Location: login.php');
    exit();
}


$jsonFile = 'items.json';
$items = json_decode(file_get_contents($jsonFile), true);

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
    <link rel="stylesheet" href="styles/welcome.css?v=<?php echo time(); ?>">
</head>

<body class="body-prop">
    <?php require 'partials/_nav.php'?>

    <?php
    $alerts = [
        "alr_added" => "Item is already present in the cart",
        "added" => "Added to Cart",
        "order_placed" => "Your order has been placed! Rest assured, it should arrive in a couple of days."
    ];

    foreach ($alerts as $sessionKey => $message) {
        if (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] == true) {
            echo "
            <div class='alert alert-" . ($sessionKey == 'alr_added' ? 'warning' : 'success') . " alert-dismissible fade show' role='alert'>
                <strong>$message</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            unset($_SESSION[$sessionKey]);
        }
    }
    ?>

    <div class='card-container d-flex flex-row justify-content-around'>
        <?php foreach ($items as $item) : ?>
            <div class="item-card text-center">
                <img src="<?php echo $item['item-pic']; ?>" class="item-img">
                <form action="item_page.php" method="POST">
                    <div class="item-info">
                        <br>
                        <h6 class="h6-text"><?php echo $item['item-name']; ?></h6>
                        <div class="d-flex flex-row justify-content-around">
                            <p class="money-text">₹<?php echo $item['item-price']; ?></p>
                            <button type="submit" class="btn btn-outline-info">View Details</button>
                        </div>
                    </div>
                    <input type="hidden" name="item-pic" value="<?php echo $item['item-pic']; ?>">
                    <input type="hidden" name="item-name" value="<?php echo $item['item-name']; ?>">
                    <input type="hidden" name="item-price" value="<?php echo $item['item-price']; ?>">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <?php require 'partials/_footer.php'; ?>
</body>

</html>
