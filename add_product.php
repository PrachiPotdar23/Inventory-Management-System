<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['name'], $_POST['description'], $_POST['quantity'], $_POST['price']) &&
        !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['quantity']) && !empty($_POST['price'])) {
        
        
        $name = $_POST['name'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        
        include 'db.php'; 
        
        $sql = "INSERT INTO products (name, description, quantity, price) VALUES ('$name', '$description', '$quantity', '$price')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else {
        
        echo "Please fill in all the required fields.";
    }
} else {
    
    echo "Invalid request method";
}
?>
