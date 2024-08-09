<?php
session_start();
error_reporting(0);

if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}

include('header.php');
include('includes/connection.php');

$id = $_SESSION['id'];
$fetch_data = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE id='$id'");
$res = mysqli_fetch_array($fetch_data);
$empid = $res['employee_id'];

$msg = '';
if (isset($_POST['change_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $msg = "Passwords do not match.";
    } elseif (strlen($new_password) <= 6) {
        $msg = "Password must be at least 6 characters long.";
    } else {
        // Hash the password for better security
        

        $update_query = mysqli_query($connection, "UPDATE tbl_employee SET password='$new_password' WHERE employee_id='$empid'");
        if ($update_query) {
            $msg = "Employee Password successfully Changed.";
        } else {
            $msg = "Password change failed.";
        }
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <h2 class="page-title">Change Password</h2>
                <div class="card">
                    <div class="card-body">
                        <form method="post" id="changePasswordForm">
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="change_password">Change Password</button>
                            <?php if (!empty($msg)): ?>
                                <div class="mt-3 alert alert-<?php echo (strpos($msg, 'success') !== false) ? 'success' : 'danger'; ?>" role="alert">
                                    <?php echo $msg; ?>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
    var newPassword = document.getElementById('new_password').value;
    var confirmPassword = document.getElementById('confirm_password').value;

    if (newPassword !== confirmPassword) {
        event.preventDefault();
        alert('Passwords do not match.');
    } else if (newPassword.length < 6) {
        event.preventDefault();
        alert('Password must be at least 6 characters long.');
    }
});
</script>
