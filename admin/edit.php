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

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $building = $_POST['building'];
    $purpose = $_POST['purpose'];
    $phone = $_POST['phone'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    $sql = "UPDATE visitors SET date='$date', name='$name', building='$building', purpose='$purpose', phone='$phone', checkin='$checkin', checkout='$checkout' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM visitors WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Visitor</title>
    <link rel="stylesheet" type="text/css" href="../styles.css">
</head>
<body>
    <div class="container">
        <h2>Edit Visitor</h2>
        <form method="post" action="edit.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <table>
                <tr>
                    <td><label for="date">Date:</label></td>
                    <td><input type="date" id="date" name="date" value="<?php echo $row['date']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="name">Name:</label></td>
                    <td><input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="building">Building:</label></td>
                    <td><input type="text" id="building" name="building" value="<?php echo $row['building']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="purpose">Purpose:</label></td>
                    <td><input type="text" id="purpose" name="purpose" value="<?php echo $row['purpose']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td><input type="tel" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="checkin">Check-in Time:</label></td>
                    <td><input type="time" id="checkin" name="checkin" value="<?php echo $row['checkin']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="checkout">Check-out Time:</label></td>
                    <td><input type="time" id="checkout" name="checkout" value="<?php echo $row['checkout']; ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="update" value="Update" class="button"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
