<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
    
</head>
<body>
    <h1>Edit Product</h1>

    

    <form action="update_product.php" method="post">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>

            <?php
            include 'db.php'; 
            
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td class='editable'><input type='text' name='name[]' value='" . $row['name'] . "'></td>";
                    echo "<td class='editable'><textarea name='description[]'>" . $row['description'] . "</textarea></td>";
                    echo "<td class='editable'><input type='number' name='quantity[]' value='" . $row['quantity'] . "'></td>";
                    echo "<td class='editable'><input type='text' name='price[]' value='" . $row['price'] . "'></td>";
                    echo "<td><a href='update_product.php?id=" . $row['id'] . "'>Update</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No products available</td></tr>";
            }
            $conn->close();
            ?>
        </table>
        <input type="submit" value="Save Changes">
    </form>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo "<p>Information saved successfully!</p>";
    }
    ?>
    
    <br>
    <a href="show_products.php">show changes</a>
    <br>
    <a href="index.html">Back to Home</a> 
</body>
</html>
