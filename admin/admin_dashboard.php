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

// Mengambil data dari tabel visitors
$sql = "SELECT * FROM visitors ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>
    <footer class="top-footer">
        <img src="../logo4.png" alt="logo" class="logo">
    </footer>

    <div class="table-container">
        <h2>Data Pengunjung</h2>
        <a href="add.php" class="button">Tambah Data Pengunjung</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Bangunan</th>
                    <th>Tujuan</th>
                    <th>Telepon</th>
                    <th>Waktu Check-in</th>
                    <th>Waktu Check-out</th>
                    <th>Dibuat Pada</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["date"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["building"] . "</td>
                                <td>" . $row["purpose"] . "</td>
                                <td>" . $row["phone"] . "</td>
                                <td>" . $row["checkin"] . "</td>
                                <td>" . $row["checkout"] . "</td>
                                <td>" . $row["created_at"] . "</td>
                                <td><a href='edit.php?id=" . $row["id"] . "'>Edit</a></td>
                                <td><a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No visitors found</td></tr>";
                }
                ?>
            </tbody>
        </table>
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
