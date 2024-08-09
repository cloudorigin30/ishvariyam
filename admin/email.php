<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');
?>

<?php
// Include PHPMailer classes at the top of the file
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>


    <div class="container pt-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Email to My Employee</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="empid">Select Employee:</label>
                                <select class="form-control" name="empid" id="empid">
                                    <?php
                                    $branch=$_SESSION['branch'];
                                    $sql = "SELECT employee_id, first_name FROM tbl_employee WHERE department='$branch'";
                                    $result = $connection->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['employee_id'] . "'>" ."Emp_Id ---> "."  " . $row['employee_id'] ."  Name : ".   $row['first_name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No employees found</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" name="message"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="attachment">Attachment:</label>
                                <input type="file" class="form-control-file" id="attachment" name="attachment">
                            </div>
                            <button type="submit" name="email-btn" class="btn btn-primary btn-block">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['email-btn'])) {
        $empid = $_POST['empid'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $branch=$_SESSION['branch'];

        $sql = "SELECT emailid FROM tbl_employee WHERE employee_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $empid);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->fetch();
        $stmt->close();

        if ($email) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP(); // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
                $mail->SMTPAuth = true; // Enable SMTP authentication
                $mail->Username = 'ishvaryamwomensfotunefundation@gmail.com'; // SMTP username
                $mail->Password = 'gzel cofs gllu pgde'; // SMTP password
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587; // TCP port to connect to

                $mail->setFrom('ishvaryamwomensfotunefundation@gmail.com', 'IshvaryamWomens');
                $mail->addAddress($email);
                $mail->Subject = $subject;
                $mail->Body = $message;

                // Handle attachment
                if (!empty($_FILES['attachment']['tmp_name'])) {
                    $mail->addAttachment($_FILES['attachment']['tmp_name'], $_FILES['attachment']['name']);
                }

                $mail->send();
                $msg = 'Email has been sent';
            } catch (Exception $e) {
                $msg = 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } else {
            $msg = 'Employee email not found.';
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        <?php
        if (isset($msg)) {
            echo 'swal("' . addslashes($msg) . '");';
        }
        ?>
    </script>

