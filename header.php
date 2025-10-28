<?php
if (!isset($pageTitle)) $pageTitle = "EventHub";
if (!isset($bodyClass)) $bodyClass = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> - EventHub</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body<?php if (!empty($bodyClass)) echo ' class="' . htmlspecialchars($bodyClass) . '"'; ?>>
    <header>
        <div class="container">
            <nav>
                <div class="logo"><a href="index.php">EventHub</a></div>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="about.php">About</a></li>
                   

                    <?php if (!isset($_SESSION["username"])): ?>
                        <li><a href="login.php" class="btn">Login</a></li>
                    <?php else: ?>
                        <?php if ($_SESSION["role"] === "admin"): ?>
                            <li><a href="admin_dashboard.php">Dashboard</a></li>
                        <?php elseif ($_SESSION["role"] === "organiser"): ?>
                            <li><a href="organizer_dashboard.php">Dashboard</a></li>
                        <?php endif; ?>
                        <li><a href="logout.php" class="btn">Logout</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>