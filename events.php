<?php
session_start();
$pageTitle = "Events";
include 'header.php';
include 'includes/db.php';

// Fetch events
$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);
?>

<div class="page-header">
    <div class="container">
        <h1 class="page-title">Discover Events</h1>
        <p>Find and explore events happening around you</p>
    </div>
</div>

<main class="container">
    <div class="events-grid">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="event-card">
                    <div class="event-image" style="background-image: url('<?php echo htmlspecialchars($row['image']); ?>');"></div>
                    <div class="event-details">
                        <div class="event-date"><?php echo date("F j, Y", strtotime($row['event_date'])); ?></div>
                        <h3 class="event-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <div class="event-location">📍 <?php echo htmlspecialchars($row['location']); ?></div>
                        
                        <p class="event-description"><?php echo htmlspecialchars(substr($row['description'], 0, 120)); ?>...
                        <a href="eventdetails.php?id=<?php echo $row['id']; ?>" class="btn">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>