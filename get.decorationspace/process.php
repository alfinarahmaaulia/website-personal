<?php
// Ganti informasi koneksi MySQL sesuai dengan database Anda
$host = "localhost";
$username = "root";
$password = "";
$database = "login_db";

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk membersihkan input
function clean_input($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

// Pendaftaran pengguna
if (isset($_POST['signup'])) {
    $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $password = password_hash(clean_input($_POST['password']), PASSWORD_DEFAULT);

    // Query untuk menambahkan pengguna ke database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        header('location:home.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Masuk pengguna
if (isset($_POST['signin'])) {
    $email = clean_input($_POST['email']);
    $password = clean_input($_POST['password']);

    // Query untuk mendapatkan informasi pengguna dari database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            header('location:home.php');
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
}

// Tutup koneksi
$conn->close();
?>
