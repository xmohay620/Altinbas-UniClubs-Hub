<?php
include 'db_connect.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Altinbas UniClubs Hub</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="accessibility-bar">
        <button onclick="changeFontSize('increase')" title="Increase Font">A+ Increase Font</button>
        <button onclick="changeFontSize('decrease')" title="Decrease Font">A- Decrease Font</button>
        <a href="admin_login.php" class="admin-link">Admin Portal</a>
    </div>

    <header>
        <img src="logo.png" alt="Altinbas University Logo" class="uni-logo">
        <h1>Student Clubs Directory</h1>
        <p>Discover and connect with your campus community</p>
        <input type="text" id="clubSearch" placeholder="Search for a club by name...">
    </header>

    <main id="clubsContainer">
        <?php
        $sql = "SELECT * FROM clubs";
        $res = $conn->query($sql);

        if ($res && $res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {

                $club_logo = !empty($row['logo_url']) ? $row['logo_url'] : 'https://via.placeholder.com/80/004a99/ffffff?text=Club';
                
                echo "<article class='club-card'>";

                echo "<img src='$club_logo' alt='Club Logo' onerror=\"this.src='https://via.placeholder.com/80/004a99/ffffff?text=No+Image';\">";
                echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                echo "<p id='desc" . $row['id'] . "'>" . htmlspecialchars($row['description']) . "</p>";
                

                if(!empty($row['contact_info'])) {
                    echo "<p class='contact-info'><strong>Contact:</strong> " . htmlspecialchars($row['contact_info']) . "</p>";
                }
                

                echo "<button class='audio-btn' onclick='readText(\"desc" . $row['id'] . "\")'>Listen to Description 🎧</button>";
                echo "</article>";
            }
        } else {
            echo "<div class='no-results'><p>No clubs found. Admin will add more soon!</p></div>";
        }
        ?>
    </main>

    <script src="script.js"></script>
</body>
</html>