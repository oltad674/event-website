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
    $email = $conn->real_escape_string($_POST["email"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (!empty($username) && !empty($email) && !empty($password)) {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username already exists";
        } else {
            // Insert new organiser into the database
            $stmt = $conn->prepare("INSERT INTO users(username, email, password, role) VALUES (?, ?, ?, 'organiser')");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            // Check if the account was created successfully
            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Error creating account. Please try again.";
            }
        }
    }
}

?>
<?php
$pageTitle = "Register";
require("header.php");
?>
<main>
    <div class="login-container">
        <h2 class="login-title">Register for an account</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo $error?></p>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit" class="btn submit-btn">Register</button>
        </form>

        <div class="form-footer">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</main>

<?php
require("footer.php");
?>
