<?php
include '../config/db-connect.php';
session_start();


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the database
$sql = "SELECT title, price, address, listing_date, product_image FROM products ORDER BY listing_date DESC";
$result = $conn->query($sql);

// Check if products exist
if ($result->num_rows > 0) {
    echo '<div class="product-grid">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<img src="' . $row['product_image'] . '" alt="' . $row['title'] . '">';
        echo '<div class="product-info">';
        echo '<h3>₹ ' . $row['price'] . '</h3>';
        echo '<h2><p>' . $row['title'] . '</p></h2>';
        echo '<p>' . $row['address'] . '</p>';
        echo '<p>' . date("M d", strtotime($row['listing_date'])) . '</p>';
        echo '</div>';
        echo '<button class="wishlist-btn">❤️</button>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "<p>No products found!</p>";
}

// Close the connection
$conn->close();
?>