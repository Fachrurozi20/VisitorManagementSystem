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

// Mengambil ID pengunjung dari QR Code jika ada
if (isset($_GET['id'])) {
    $visitor_id = $_GET['id'];

    // Memeriksa data pengunjung di database
    $sql = "SELECT * FROM visitors WHERE id = '$visitor_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Data pengunjung ditemukan
        $row = $result->fetch_assoc();
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Visitor Verification</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
            <div class="success-container">
                <h2>Visitor Verified!</h2>
                <p>Visitor ID: ' . htmlspecialchars($visitor_id) . '</p>
                <p>Name: ' . htmlspecialchars($row['name']) . '</p>
                <p>Building: ' . htmlspecialchars($row['building']) . '</p>
                <p>Purpose: ' . htmlspecialchars($row['purpose']) . '</p>
                <p>Check-in Time: ' . htmlspecialchars($row['checkin']) . '</p>
                <p>Check-out Time: ' . htmlspecialchars($row['checkout']) . '</p>
            </div>
        </body>
        </html>
        ';
    } else {
        // Data pengunjung tidak ditemukan
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Visitor Verification</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
        
            <footer class = "top-footer">
                <img src = "logo/logo4.png" alt="logo" class="logo">
            </footer>

            <div class="error-container">
                <h2>Verification Failed!</h2>
                <p>Visitor ID not found.</p>
                <a href="index.html" class="button">Try Again</a>
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
    }
} else {
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Visitor Verification</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="error-container">
            <h2>Verification Failed!</h2>
            <p>Invalid or missing Visitor ID.</p>
            <a href="index.html" class="button">Try Again</a>
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
}

$conn->close();
?>
