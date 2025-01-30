<?php
include 'config.php';


$result = $conn->query("SELECT * FROM users WHERE username = 'admin'");
if ($result->num_rows == 0) {

    $hashed_password = password_hash('admin123', PASSWORD_DEFAULT);
    

    $query = "INSERT INTO users (username, password, role) VALUES ('admin', '$hashed_password', 'admin')";
    if ($conn->query($query)) {
        echo "Default admin created successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Admin user already exists.";
}
?>
