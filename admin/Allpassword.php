<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}
include('header.php');
include('includes/connection.php');
?>
<div class="container mr-md-5 mt-5 pt-5">
    <h2 class="mb-4 text-center">Employee List</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Emp ID</th>
                    <th>User ID</th>
                    <th>Password</th>
                    <th>Designation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $branch=$_SESSION['branch'];
                $sql = "SELECT employee_id, username, password, designation FROM tbl_employee  WHERE department='$branch'";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['employee_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";

                        echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['designation']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
