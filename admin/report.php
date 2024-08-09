<?php
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Report</h4>
            </div>

            <form method="post">
                <div class="form-group row" style="padding: 20px;">
                    <label class="col-lg-0 col-form-label-report" for="from">From</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="datetimepicker5" name="from_date" placeholder="Select Date" required>
                    </div>

                    <label class="col-lg-0 col-form-label" for="from">To</label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="datetimepicker6" name="to_date" placeholder="Select Date" required>
                    </div>

                    <div class="col-lg-3">
                        <input type="text" class="form-control" id="department" value="<?php echo $_SESSION['branch'];?>" name="department"  disabled required>
                        
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" name="srh-btn" class="btn btn-primary search-button">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Emp Id</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <?php if(isset($_REQUEST['srh-btn'])) { ?>
                        <th>Present Days</th>
                        <th>Salary</th>
                        <th>Account_NO</th>
                        <?php } else { ?>
                        <th>Status</th>
                        <th>Location</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($_REQUEST['srh-btn'])) {
                    $from_date = $_POST['from_date']; 
                    $to_date = $_POST['to_date'];
                    $dept = $_SESSION['branch'];
                    $from_date = date('Y-m-d', strtotime($from_date));
                    $to_date = date('Y-m-d', strtotime($to_date));

                    $search_query = mysqli_query($connection, "SELECT tbl_employee.employee_id, tbl_employee.acc_no,tbl_employee.House_rent,tbl_employee.Telephone_bill,tbl_employee.Extra,tbl_employee.Travel_Allowance,tbl_employee.Insentive,tbl_employee.salary_deduction,tbl_employee.gst, tbl_employee.first_name, tbl_employee.last_name, tbl_employee.department, tbl_employee.designation, tbl_employee.salary, COUNT(tbl_attendance.date) AS present_days FROM tbl_employee INNER JOIN tbl_attendance ON tbl_attendance.employee_id = tbl_employee.employee_id WHERE tbl_employee.department = '$dept' AND DATE(tbl_attendance.date) BETWEEN '$from_date' AND '$to_date' GROUP BY tbl_employee.employee_id");

                    while($row = mysqli_fetch_array($search_query)) {
                        $empid=$row['employee_id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $department = $row['designation'];
                        $salary = $row['salary'];
                        $present_days = $row['present_days'];
                        $acc_no=$row['acc_no'];
                        $house_rent=$row['House_rent'];
                        $telephone_bill=$row['Telephone_bill'];
                        $extra=$row['Extra'];
                        $travel=$row['Travel_Allowance'];
                        $insentive=$row['Insentive'];
                        $salary_deduction=$row['salary_deduction'];
                        $gst=$row['gst'];

                        $totalsalary=($salary+$house_rent+$telephone_bill+$extra+$travel+$insentive)-($salary_deduction+$gst);
                        
                ?>
                    <tr>
                        <td><?php echo $empid;?></td>
                        <td><?php echo $first_name . " " . $last_name; ?></td>
                        <td><?php echo $department; ?></td>
                        <td><?php echo $present_days; ?></td>
                        <td><?php echo $totalsalary; ?></td>
                        <td><?php echo $acc_no;?></td>
                    </tr>
                <?php 
                    }
                } else { 
                    $branch=$_SESSION['branch'];
                    $date = date('Y-m-d');  
                    $fetch_query = mysqli_query($connection, "SELECT tbl_employee.employee_id,tbl_employee.first_name, tbl_employee.last_name, tbl_employee.department, tbl_employee.designation, tbl_attendance.latitude, tbl_attendance.longitude FROM tbl_employee INNER JOIN tbl_attendance ON tbl_attendance.employee_id = tbl_employee.employee_id WHERE tbl_attendance.date = '$date'and tbl_attendance.department='$branch' ");
                    while($row = mysqli_fetch_array($fetch_query)) {
                         $latitude = $row['latitude'];
                         $longitude = $row['longitude'];
                         $empid=$row['employee_id'];
                ?>
                    <tr><td><?php echo $empid;?></td>
                        <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                        <td><?php echo $row['designation']; ?></td>
                        <td class="text-success">Present</td>
                        <td>
                            <button class="btn btn-info" onclick='showLocation(<?php echo $latitude; ?>, <?php echo $longitude; ?>)'>View On Map</button>
                        </td>
                    </tr>
                <?php 
                    }
                } 
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="locationModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">Employee Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="mapFrame" style="width: 100%; height: 400px; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<script>
function showLocation(latitude, longitude) {
    var mapUrl = `https://www.google.com/maps?q=${latitude},${longitude}&hl=en&z=15&output=embed`;
    document.getElementById('mapFrame').src = mapUrl;
    $('#locationModal').modal('show');
}
</script>
