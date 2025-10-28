<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
include 'header.php';
include 'includes/db.php';

$pageTitle = "Admin Dashboard";
$bodyClass = "dashboard-layout";


$sql = "SELECT events.id, events.title, events.event_date, users.username AS organiser 
        FROM events 
        JOIN users ON events.organiser_id = users.id 
        ORDER BY events.event_date DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>EventHub</h2>
    </div>
    <div class="user-info">
        <div class="user-avatar">A</div>
        <div>
            <div class="user-name">Admin User</div>
            <div class="user-role">Administrator</div>
        </div>
    </div>
  
    <div class="sidebar-footer">
        <a href="index.php" class="btn" style="width: 100%; text-align: center;">Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="dashboard-page-header">
        <h1 class="dashboard-page-title">Admin Dashboard</h1>
       
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-title">Total Events</div>
            <div class="stat-value"><?php echo mysqli_num_rows($result); ?></div>
        </div>
    </div>

    <h2 style="margin-bottom: 1rem;">Recent Events</h2>
    <table class="events-table">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Organizer</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><?php echo htmlspecialchars($row['organiser']); ?></td>
                <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                <td class="action-buttons">
                    <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                    <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"
                       onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>

