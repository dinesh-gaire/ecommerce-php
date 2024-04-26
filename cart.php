<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/cart.css?v=<?php echo time(); ?>">
</head>

<body class="bg-navy">
    <?php require 'partials/_nav.php' ?>
    <?php
        if((isset($_SESSION["removed"])) && $_SESSION["removed"]==true){
            echo"
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Removed from Cart</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            unset($_SESSION['removed']);
        }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <table class="table table-striped table-dark table-hover table-border">
                    <thead class="text-center">
                        <tr>
                            <th scope="col-6">Image</th>
                            <th scope="col-4">Name</th>
                            <th scope="col-4">Price</th>
                            <th scope="col-4">Quantity</th>
                            <th scope="col-4">Total</th>
                            <th scope="col-4"><br></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        if (isset($_SESSION['cart'])) {

                            foreach ($_SESSION['cart'] as $key => $value) {
                                ?>
                                <tr>
                                    <td class='align-middle col-6'><img class='cart-img' src="<?php echo $value['item_pic']; ?>"></td>
                                    <td class='align-middle col-4'><?php echo $value['item_name']; ?></td>
                                    <td class='align-middle col-4'>₹ <?php echo $value['item_price']; ?>
                                        <input type="hidden" class="iprice" value="<?php echo $value['item_price']; ?>">
                                    </td>
                                    <td class='align-middle col-4'>
                                        <form action='manage_cart.php' method='POST'>
                                            <input class="text-center iquantity" type='number' onchange="this.form.submit();" name='mod_quantity' value='<?php echo $value['item_quantity']; ?>' min='1' max='10'>
                                            <input type='hidden' name='item_name' value='<?php echo $value['item_name']; ?>'>
                                        </form>
                                    </td>
                                    <td class="align-middle itotal col-4"></td>
                                    <td class='align-middle col-4'>
                                        <form action='manage_cart.php' method='POST'>
                                            <button type='submit' name='remove' class='btn btn-danger btn-sm'>Remove</button>
                                            <input type='hidden' name='item_name' value='<?php echo $value['item_name']; ?>'>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                
                            }
                            
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-3">
                <div class="card card-bg">
                    <div class="card-body text-center">
                        <h5 class="card-title">Grand Total is:</h5>
                        <p class="card-text gtotal" id="gtotal">₹ <?php echo $total; ?></p>
                        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var iprice = document.getElementsByClassName('iprice');
        var iquantity = document.getElementsByClassName('iquantity');
        var itotal = document.getElementsByClassName('itotal');
        var gtotal = document.getElementById('gtotal');
        var gt=0;

        function subTotal(){
            gt=0;
            for(i=0; i<iprice.length; i++)
            {
                itotal[i].innerText = (iprice[i].value)*(iquantity[i].value);
                gt += (iprice[i].value)*(iquantity[i].value);
            }
            gtotal.innerText = gt;
        }

        subTotal();
    </script>
    <div class="d-flex flex-column justify-content-end">
        <?php require 'partials/_footer.php'; ?>
    </div>
</body>

</html>
