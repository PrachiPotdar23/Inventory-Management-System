<!DOCTYPE html>
<html>
<head>
    <title>Delete Product</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
</head>
<body>
    <h1>Delete Product</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Delete</th>
        </tr>
        <?php
        include 'db.php'; 

        
        $sql = "SELECT id, name FROM products";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td><a href='delete_product.php?id=" . $row['id'] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No products available</td></tr>";
        }

        
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $product_id = $_GET['id'];

            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $product_id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo "<tr><td colspan='3'>Product deleted successfully.</td></tr>";
                } else {
                    echo "<tr><td colspan='3'>Failed to delete product.</td></tr>";
                }
                $stmt->close();
            } else {
                echo "<tr><td colspan='3'>Error in deletion: " . $conn->error . "</td></tr>";
            }
        }
        $conn->close();
        ?>
    </table>
    <a href="index.html">Back to Home</a>
</body>
</html>
