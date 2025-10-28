<?php
session_start();

// Check if user is logged in and has an allowed role
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    $role = $_SESSION["role"];

    // Only allow admin or organiser
    if ($role !== "admin" && $role !== "organiser") {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Event deleted successfully.";
        } else {
            echo "Error deleting event.";
        }

        $stmt->close();

        // Redirect back depending on the user's role
        if ($role === "admin") {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: organizer_dashboard.php");
        }
        exit();
    } else {
        echo "Invalid event ID.";
    }
} else {
    echo "Invalid request method.";
}
?>