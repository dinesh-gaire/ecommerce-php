<?php
session_start();
if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true){
    header('Location: login.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted data from the form
    $itemPic = $_POST['item-pic'];
    $itemName = $_POST['item-name'];
    $itemPrice = $_POST['item-price'];
    $itemQuantity = 1;

    // Load the JSON data from the file
    $jsonData = file_get_contents('items.json');

    // Decode the JSON data into an associative array
    $items = json_decode($jsonData, true);

    // Find the item in the array
    $selectedItem = null;
    foreach ($items as $item) {
        if ($item['item-name'] == $itemName && $item['item-price'] == $itemPrice) {
            $selectedItem = $item;
            break;
        }
    }

    if ($selectedItem) {
        // Display the stored information about the item
        $itemInfo = $selectedItem['item-info'];
    } else {
        // Redirect to the home page if the item is not found
        header('Location: welcome.php');
        exit();
    }
} else {
    // Redirect to the home page if the form is not submitted
    header('Location: welcome.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $itemName; ?> Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/item_page.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php require 'partials/_nav.php'; ?>

    <div class="container mt-4">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $itemPic; ?>" alt="Item Image" class="card-img-top item-img">
                </div>
                <div class="col-md-8 seperation">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $itemName; ?></h2>
                        <p class="money-text">₹<?php echo number_format($itemPrice, 2); ?></p>
                        <form action="manage_cart.php" method="POST">
                            <button type="submit" name="add_to_cart" class="btn btn-success">+ Add to Cart</button>
                            <input type="hidden" name="item_name" value="<?php echo $itemName; ?>">
                            <input type="hidden" name="item_price" value="<?php echo $itemPrice; ?>">
                            <input type="hidden" name="item_pic" value="<?php echo $itemPic; ?>">
                            <input type="hidden" name="item_quantity" value="<?php echo $itemQuantity; ?>">
                        </form>
                        <div class="card-info">
                            <h6>Item Info</h6>
                            <ul>
                                <li><p class="card-text"><?php echo $itemInfo['p1']; ?></p></li>
                                <li><p class="card-text"><?php echo $itemInfo['p2']; ?></p></li>
                                <li><p class="card-text"><?php echo $itemInfo['p3']; ?></p></li>
                                <li><p class="card-text"><?php echo $itemInfo['p4']; ?></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <div class="d-flex flex-column justify-content-end">
        <?php require 'partials/_footer.php'; ?>
    </div>
    </body>
</html>

