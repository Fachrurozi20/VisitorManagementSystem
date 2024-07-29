<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "visitor_management_system";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $date = $_POST['date'];
    $name = $_POST['name'];
    $building = $_POST['building'];
    $purpose = $_POST['purpose'];
    $phone = $_POST['phone'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $sql = "INSERT INTO visitors (date, name, building, purpose, phone, checkin, checkout, created_at) 
            VALUES ('$date', '$name', '$building', '$purpose', '$phone', '$checkin', '$checkout', NOW())";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Visitor</title>
    <link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>
    <footer class="top-footer">
        <img src="../logo4.png" alt="logo" class="logo">
    </footer>
    <div class="container">
        <h2>Tambah Data Pengunjung</h2>
        <form method="post" action="add.php">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="building">Building:</label>
            <input type="text" id="building" name="building" required>
            <label for="purpose">Purpose:</label>
            <input type="text" id="purpose" name="purpose" required>
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>
            <label for="checkin">Check-in Time:</label>
            <input type="time" id="checkin" name="checkin" required>
            <label for="checkout">Check-out Time:</label>
            <input type="time" id="checkout" name="checkout" required>
            <input type="submit" name="add" value="Add">
        </form>
    </div>
    <footer class="footer">
        <div class="left">
            <p>&copy; PT TELEKOMUNIKASI SELULAR, 2024.</p>
        </div>
        <div class="right">
            <a href="https://www.telkomsel.com/privacy-policy">Privacy Policy</a> 
            <a href="https://www.telkomsel.com/terms-and-conditions">Terms of Service</a>
            <a href="https://www.telkomsel.com/support/contact-us">Contact Us</a>
        </div>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
