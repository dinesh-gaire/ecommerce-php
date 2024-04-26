<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header('Location: login.php');
    exit();
}?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    </head>
    <body>
        <?php
        $added = false;
        $alr_added = false;
        $removed = false;
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['add_to_cart']))
            {
                if(isset($_SESSION['cart']))
                {
                    $existing_items = array_column($_SESSION['cart'], 'item_name');
                    if(in_array($_POST['item_name'], $existing_items))
                    {
                        $alr_added = true;
                        $_SESSION['alr_added'] = $alr_added;
                        echo "
                        <script>
                            window.location.href = 'item_page.php';
                        </script>
                        ";
                    }
                    else{
                        $added = true;
                        $_SESSION['added'] = $added;

                        $count = count($_SESSION['cart']);
                        $_SESSION['cart'][$count] = array('item_pic' => $_POST['item_pic'], 'item_name' => $_POST['item_name'], 'item_price' => $_POST['item_price'], 'item_quantity' => $_POST['item_quantity']);
                        $_SESSION['count']++; // Increment the count directly
                        echo "
                        <script>
                            window.location.href = 'item_page.php';
                        </script>
                        ";
                    }
                }
                else
                {
                    $added = true;
                    $_SESSION['added'] = $added;
                    $_SESSION['cart'][0] = array('item_pic' => $_POST['item_pic'], 'item_name' => $_POST['item_name'], 'item_price' => $_POST['item_price'], 'item_quantity' => $_POST['item_quantity']);
                    $_SESSION['count'] = 1; // Initialize count if cart is empty
                    echo "
                    <script>
                        window.location.href = 'item_page.php';
                    </script>";
                }
            }
            if (isset($_POST['remove'])) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($value['item_name'] == $_POST['item_name']) {
                        unset($_SESSION['cart'][$key]);
                        $_SESSION['cart'] = array_values($_SESSION['cart']);
        
                        // Update item count
                        $_SESSION['count'] = count($_SESSION['cart']);
                        $removed = true;
                        $_SESSION['removed'] = $removed;
                        echo "
                        <script>
                            window.location.href = 'cart.php';
                        </script>";
                    }
                }
            }

            if (isset($_POST['mod_quantity'])) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    if ($value['item_name'] == $_POST['item_name']) {
                        $_SESSION['cart'][$key]['item_quantity'] = $_POST['mod_quantity'];
                        echo "
                        <script>
                            window.location.href = 'cart.php';
                        </script>";
                    }
                }
            }
        }
        ?>
        
    </body>
</html>
