<?php
session_start();
$pageTitle = "Home";
include 'header.php';
require 'includes/db.php';

$today = date('Y-m-d');
?>

<section class="hero-with-image">
    <div class="hero-overlay">
    <div class="hero-content">
        <h1>Discover Amazing Events</h1>
        <p>Find and explore events happening around you. Join the community and never miss out on what matters to you.</p>
        <a href="events.php" class="btn">Browse Events</a>
    </div>
    </div>
</section>

<section class="featured-events container">
    <h2 class="section-title">Featured Events</h2>
    <div class="events-grid">
        <?php
        $stmt = $conn->query("SELECT events.*, users.username FROM events JOIN users ON events.organiser_id = users.id ORDER BY event_date ASC LIMIT 6");

        while ($event = $stmt->fetch_assoc()) {
            $dateObj = date_create($event['event_date']);
            $formattedDate = date_format($dateObj, 'F j, Y');
            $image = !empty($event['image']) ? $event['image'] : 'https://source.unsplash.com/random/600x400/?event';
        ?>
        <div class="event-card">
            <div class="event-image" style="background-image: url('<?php echo htmlspecialchars($image); ?>')"></div>
            <div class="event-details">
                <div class="event-date"><?php echo $formattedDate; ?></div>
                <h3 class="event-title"><?php echo htmlspecialchars($event['title']); ?></h3>
                <div class="event-location">📍 <?php echo htmlspecialchars($event['location']); ?></div>
                <p class="event-description">
                    <?php echo htmlspecialchars(substr($event['description'], 0, 120)); ?>...
                </p>
                <a href="eventdetails.php?id=<?php echo $event['id']; ?>" class="btn">View Details</a>
            </div>
        </div>
        <?php } ?>
    </div>
</section>

<?php include 'footer.php'; ?>