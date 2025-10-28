<?php
// Session management
session_start();
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] === "admin") {
        header("Location: admin_dashboard.php");
        exit();
    } else if ($_SESSION["role"] === "organiser") {
        header("Location: organizer_dashboard.php");
        exit();
    }
}

// Authentication
$error = "";
require_once("includes/db.php");

if (isset($_POST["submit"])) {
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $_POST["password"];

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user["password"])) {
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["user_id"] = $user["id"]; // Store user ID if needed later

                if ($user["role"] === "admin") {
                    header("Location: admin_dashboard.php");
                    exit();
                } else {
                    header("Location: organizer_dashboard.php");
                    exit();
                }
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Please enter both username and password.";
    }
}
?>
<?php
$pageTitle = "Login";
include 'header.php';
?>

<main>
    <div class="login-container">
        <h2 class="login-title">Login to Your Account</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red;">Invalid username or password.</p>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn submit-btn">Login</button>
        </form>

        <div class="form-footer">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>