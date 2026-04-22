<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: admin_login.php"); exit(); }
include 'db_connect.php';

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM clubs WHERE id = $id");
$club = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $n = mysqli_real_escape_string($conn, $_POST['n']);
    $d = mysqli_real_escape_string($conn, $_POST['d']);
    $l = mysqli_real_escape_string($conn, $_POST['l']);
    $c = mysqli_real_escape_string($conn, $_POST['c']);
    $conn->query("UPDATE clubs SET name='$n', description='$d', logo_url='$l', contact_info='$c' WHERE id=$id");
    header("Location: admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Edit Club</title><link rel="stylesheet" href="style.css"></head>
<body style="padding:50px; text-align:center;">
    <div style="display:inline-block; text-align:left; background:white; padding:30px; border-radius:15px; border-top:8px solid var(--main-blue); box-shadow:0 0 20px rgba(0,0,0,0.1);">
        <h2>Update Club Information</h2>
        <form method="POST">
            Name: <br><input type="text" name="n" value="<?php echo $club['name']; ?>" style="width:300px; padding:8px; margin-bottom:15px;"><br>
            Logo URL: <br><input type="text" name="l" value="<?php echo $club['logo_url']; ?>" style="width:300px; padding:8px; margin-bottom:15px;"><br>
            Contact: <br><input type="text" name="c" value="<?php echo $club['contact_info']; ?>" style="width:300px; padding:8px; margin-bottom:15px;"><br>
            Description: <br><textarea name="d" style="width:300px; height:100px; padding:8px;"><?php echo $club['description']; ?></textarea><br>
            <br><button type="submit" name="update" style="background:var(--main-blue); color:white; padding:10px 20px; border:none; cursor:pointer; width:100%;">Update Changes</button>
        </form>
    </div>
</body>
</html>