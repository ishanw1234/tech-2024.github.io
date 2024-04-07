
<?php
// Database connection details (replace with your own)
$db_host = "sql300.infinityfree.com";
$db_user = "if0_36323453";
$db_password = "rC9ypAkNMH";
$db_name = "if0_36323453_login";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Validate user input (replace with more robust validation)
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

// Check if passwords match
if ($password !== $confirm_password) {
    die("Passwords do not match!");
}

// Hash the password before storing it (use a strong hashing algorithm like bcrypt)
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Prepare SQL statement to insert new user (replace with parameterized queries for better security)
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
>