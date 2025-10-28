<?php
session_start();
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] === "admin") {
        header("Location: index.php");
        exit();
    }
} //else {
    //header("Location: index.php");
    //exit();
//}
include 'header.php';

include_once("includes/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $location = trim($_POST['location']);
    $description = trim($_POST['description']);
    $date = trim($_POST['date']);
    $organiser_id = $_SESSION['user_id'];

    // Validate required fields
    $errors = [];

    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    if (empty($location)) {
        $errors[] = "Location is required.";
    }
    if (empty($description)) {
        $errors[] = "Description is required.";
    }
    if (empty($date)) {
        $errors[] = "Start date is required.";
    }


    // Handle poster upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $upload_dir = 'image/';
        $image_path = $upload_dir . $image_name;

        // Ensure upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        move_uploaded_file($image_tmp, $image_path);
    }


    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO events (title, location, description, event_date, image, organiser_id) VALUES (?, ?, ?, ?, ?, ?);");
        $stmt->bind_param("sssssi", $title, $location, $description, $date, $image_path, $organiser_id );
        $stmt->execute();
        $stmt->close();
        header("Location: organizer_dashboard.php");
        exit;
    } else {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>


<?php
$pageTitle = "Add New Event";
$bodyClass = "dashboard-layout";

?>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>EventHub</h2>
    </div>
    <div class="user-info">
        <div class="user-avatar">O</div>
        <div>
            <div class="user-name">Organizer Name</div>
            <div class="user-role">Event Organizer</div>
        </div>
    </div>
    <ul class="sidebar-menu">
       
        <li><a href="add_event.php" class="active">Create Event</a></li>
       
    </ul>
    <div class="sidebar-footer">
        <a href="index.php" class="btn" style="width: 100%; text-align: center;">Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="dashboard-page-header">
        <h1 class="dashboard-page-title">Create New Event</h1>
    </div>
    
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="event_title">Event Title *</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="event_date">Event Date *</label>
                    <input type="date" id="date" name="date" required>
                </div>
                
                
            </div>
            
            <div class="form-group">
                <label for="event_location">Location *</label>
                <input type="text" id="location" name="location" placeholder="Venue name, address, or online" required>
            </div>
            
            <div class="form-group">
                <label for="event_description">Event Description *</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="event_image">Event Image</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='organizer_dashboard.php'">Cancel</button>
                <button type="submit" class="btn">Create Event</button>
            </div>
        </form>
    </div>
</div>

<?php ?>
</body>
</html>