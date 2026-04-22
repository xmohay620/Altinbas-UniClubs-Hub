<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: admin_login.php"); exit(); }
include 'db_connect.php';

// Add Club Logic
if (isset($_POST['add'])) {
    $n = mysqli_real_escape_string($conn, $_POST['n']);
    $d = mysqli_real_escape_string($conn, $_POST['d']);
    $l = mysqli_real_escape_string($conn, $_POST['l']);
    $c = mysqli_real_escape_string($conn, $_POST['c']);
    $conn->query("INSERT INTO clubs (name, description, logo_url, contact_info) VALUES ('$n','$d','$l','$c')");
}

// Delete Club Logic
if (isset($_GET['del'])) {
    $id = intval($_GET['del']);
    $conn->query("DELETE FROM clubs WHERE id=$id");
    header("Location: admin_dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="padding:30px;">
    <h1 style="color:var(--main-blue)">Admin Management Dashboard</h1>
    <p><a href="index.php">← Back to Site</a> | <a href="logout.php" style="color:red;">Logout</a></p>
    <hr>
    
    <h3>Add New Club</h3>
    <form method="POST" style="background:#fff; padding:20px; border-radius:10px; border:1px solid #ddd;">
        <input type="text" name="n" placeholder="Club Name" required style="width:20%; padding:10px;">
        <input type="text" name="c" placeholder="Contact Info" style="width:20%; padding:10px;">
        <input type="text" name="l" placeholder="Logo Image URL" style="width:30%; padding:10px;">
        <br><br>
        <textarea name="d" placeholder="Description" required style="width:100%; height:60px; padding:10px;"></textarea>
        <br><button type="submit" name="add" style="padding:10px 30px; background:green; color:white; border:none; border-radius:5px; cursor:pointer; margin-top:10px;">+ Save Club</button>
    </form>

    <hr>
    <h3>Club List</h3>
    <table>
        <tr>
            <th>Club Name</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
        <?php
        $res = $conn->query("SELECT * FROM clubs");
        while($row = $res->fetch_assoc()) {
            echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['contact_info']}</td>
                <td>
                    <a href='edit_club.php?id={$row['id']}' style='color:blue; text-decoration:none;'>Edit</a> | 
                    <a href='admin_dashboard.php?del={$row['id']}' onclick='return confirm(\"Are you sure?\")' style='color:red; text-decoration:none;'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>