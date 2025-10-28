<?php
require 'includes/db.php';

// Check if 'id' is passed in URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid event ID.";
    exit;
}

$event_id = (int)$_GET['id'];

// Prepare and execute query securely
$stmt = $conn->prepare("
    SELECT events.*, users.username AS organiser_name 
    FROM events 
    JOIN users ON events.organiser_id = users.id 
    WHERE events.id = ?
");

$stmt->bind_param("i", $event_id); 
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    echo "Event not found.";
    exit;
}

$pageTitle = htmlspecialchars($event['title']);
include 'header.php';
?>

<section class="event-details container">
    <h1><?php echo htmlspecialchars($event['title']); ?></h1>

    <?php if (!empty($event['image'])): ?>
        <img src="<?php echo htmlspecialchars($event['image']); ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" style="max-width: 25%; height: auto; margin-bottom: 20px;">
    <?php endif; ?>

    <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($event['event_date'])); ?></p>
    <p><strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?></p>
    <p><strong>Organiser:</strong> <?php echo htmlspecialchars($event['organiser_name']); ?></p>
    <hr>
    <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>

    <a href="index.php" class="btn" style="margin-top: 20px;">Back to Home</a>
</section>

<?php include 'footer.php'; ?>