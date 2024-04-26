<?php
session_start();
require 'partials/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['order_arrived'])) {
        $item_id = $_POST['item_id'];
        $order_id = $_POST['order_id'];

        $userEmail = $_SESSION['Email'];
        $checkEmailQuery = "SELECT * FROM orders WHERE id = '$order_id' AND email = '$userEmail'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            // Remove the item from the order
            $deleteOrderItemQuery = "
                DELETE FROM order_items
                WHERE order_id = ? AND email = ? AND item_id = ?;
            ";

            $stmt = $conn->prepare($deleteOrderItemQuery);
            $stmt->bind_param("isi", $order_id, $userEmail, $item_id);
            $stmt->execute(); // Delete item from order_items table

            // Update items in the orders table
            $updateItemsQuery = "
                UPDATE orders
                SET items = ?
                WHERE id = ? AND email = ?;
            ";

            $result = $conn->query("SELECT * FROM orders WHERE id = '$order_id' AND email = '$userEmail'");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $orderItems = json_decode($row['items'], true);

                // Find and remove the specific item from $orderItems
                foreach ($orderItems as $key => $orderItem) {
                    if ($orderItem['item_id'] == $item_id) {
                        unset($orderItems[$key]);
                        break;
                    }
                }

                $updatedItems = json_encode(array_values($orderItems)); // Reindex the array after removal
                $stmt = $conn->prepare($updateItemsQuery);
                $stmt->bind_param("sis", $updatedItems, $order_id, $userEmail);
                $stmt->execute();
            }
        }
    }
}

// Fetch orders from the database based on user's email
$userEmail = $_SESSION['Email'];
$sql = "SELECT * FROM orders WHERE email = '$userEmail'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Your Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/your_orders.css?v=<?php echo time(); ?>">
</head>

<body class="body-prop bg-navy">
    <?php require 'partials/_nav.php'?>
    <div class="d-flex flex-row justify-content-center my-4">
        <h1 class="orders-text">Your Orders</h1>
    </div>

    <?php
    $allRowsHaveEmptyItems = true; // Flag to check if all rows have empty items
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orderItems = json_decode($row['items'], true);
            if (!empty($orderItems)) {
                $allRowsHaveEmptyItems = false;
                break;
            }
        }
    }

    if ($allRowsHaveEmptyItems) {
        echo '<div class="d-flex justify-content-center mt-4"><p class="orders-text">No pending orders</p></div>';
    } else {
    ?>
        <div class="ex-padding d-flex flex-row justify-content-center">
            <table class="table table-responsive table-border table-bordered table-striped table-dark table-hover">
                <thead class="text-center">
                    <tr>
                        <th>Item Image</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $result->data_seek(0); // Reset result set pointer
                    while ($row = $result->fetch_assoc()) {
                        $orderItems = json_decode($row['items'], true);
                        if (!empty($orderItems)) {
                            foreach ($orderItems as $orderItem) {
                    ?>
                                <tr>
                                    <td><img src="<?php echo $orderItem['item_pic']; ?>" alt="Item Image" class="cart-img"></td>
                                    <td><?php echo $orderItem['item_name']; ?></td>
                                    <td><?php echo $orderItem['item_quantity']; ?></td>
                                    <td>₹<?php echo $orderItem['item_price']; ?></td>
                                    <td>₹<?php echo $orderItem['item_price'] * $orderItem['item_quantity']; ?></td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="item_id" value="<?php echo $orderItem['item_id']; ?>">
                                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="order_arrived" class="btn btn-primary">Order Arrived</button>
                                        </form>
                                    </td>
                                </tr>
                    <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php } ?>

</body>

</html>
