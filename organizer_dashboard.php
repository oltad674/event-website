<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'organiser') {
    header("Location: index.php");
    exit();
}
include 'header.php';
include 'includes/db.php';

$pageTitle = "Organizer Dashboard";
$bodyClass = "dashboard-layout";

$userId = $_SESSION['user_id']; // Logged-in organiser's user ID

$sql = "SELECT events.id, events.title, events.event_date, events.location
        FROM events 
        WHERE events.organiser_id = ?
        ORDER BY events.event_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>EventHub</h2>
    </div>
    <div class="user-info">
        <div class="user-avatar"><?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?></div>
        <div>
            <div class="user-name"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
            <div class="user-role">Organizer</div>
        </div>
    </div>

    <div class="sidebar-footer">
        <a href="index.php" class="btn" style="width: 100%; text-align: center;">Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="dashboard-page-header">
        <h1 class="dashboard-page-title">Organizer Dashboard</h1>
        <a href="add_event.php" class="btn">Add New Event</a>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">My Total Events</div>
            <div class="stat-value"><?php echo $result->num_rows; ?></div>
        </div>
    </div>

    <h2 style="margin-bottom: 1rem;">My Recent Events</h2>
    <table class="events-table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Location</th>
                
                <th>Date</th>
                
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['location']); ?></td>
               
                <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                <td class="action-buttons">
                    <a href="edit_event.php?id=<?php echo $row['id']; ?>"><button class="btn">Edit</button></a>
                    <form action="delete_event.php" method="post" onsubmit="return confirm('Are you sure you want to delete this event?');">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>