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

// Mengambil data dari formulir
$date = $_POST['date'];
$name = $_POST['name'];
$building = $_POST['building'];
$purpose = $_POST['purpose'];
$phone = $_POST['phone'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];

// Menyimpan data ke database
$sql = "INSERT INTO visitors (date, name, building, purpose, phone, checkin, checkout, created_at) 
        VALUES ('$date', '$name', '$building', '$purpose', '$phone', '$checkin', '$checkout', NOW())";

if ($conn->query($sql) === TRUE) {
    // Mengambil ID pengunjung yang baru saja ditambahkan
    $visitor_id = $conn->insert_id;

    // Menyertakan pustaka QR Code
    include('phpqrcode/qrlib.php');

    // Menentukan path untuk menyimpan QR Code
    $qr_path = 'qrcodes/' . $visitor_id . '.png';

    // Data yang akan di-encode ke dalam QR Code
    $qr_data = 'http://localhost/VISITORMANAGEMENTSYSTEM/verify.php?id=' . $visitor_id;

    // Menghasilkan QR Code
    QRcode::png($qr_data, $qr_path);

    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Registration Success</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <footer class = "top-footer">
            <img src = "logo4.png" alt="logo" class="logo">
        </footer>

        <div class="success-container">
            <h2>Registration Successful!</h2>
            <p>Thank you for registering, ' . htmlspecialchars($name) . '.</p>
            <p>Your visit to ' . htmlspecialchars($building) . ' has been recorded.</p>
            <p>Scan the QR code below to verify your visit:</p>
            <div class="qr-code">
                <img src="' . $qr_path . '" alt="QR Code">
            </div>
            <a href="index.html" class="button">Register Another Visitor</a>
        </div>

        <footer class="footer">
            <div class="footer-left">
                <p>&copy; PT TELEKOMUNIKASI SELULAR, 2024. </p>
            </div>
            <div class="footer-right">
                <a href="https://www.telkomsel.com/privacy-policy">Privacy Policy</a> 
                <a href="https://www.telkomsel.com/terms-and-conditions">Terms of Service</a>
                <a href="https://www.telkomsel.com/support/contact-us">Contact Us</a>
            </div>
        </footer>
    </body>
    </html>
    ';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
