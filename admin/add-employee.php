<?php
session_start();
if(empty($_SESSION['name']) || $_SESSION['role']!=1)
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
$fetch_query = mysqli_query($connection, "select max(id) as id from tbl_employee");
      $row = mysqli_fetch_row($fetch_query);
      if($row[0]==0)
      {
        $emp_id = 1;
      }
      else
      {
        $emp_id = $row[0] + 1;
      }
    
    if(isset($_REQUEST['add-employee']))
    {
      $first_name = $_REQUEST['first_name'];
      $last_name = $_REQUEST['last_name'];
      $username = $_REQUEST['username'];
      $emailid = $_REQUEST['emailid'];
      $pwd = $_REQUEST['pwd'];
      $employee_id = 'EMP-'.$emp_id;
      $joining_date = $_REQUEST['joining_date'];
      $date = DateTime::createFromFormat('d/m/Y', $joining_date);
      $mysql_date_join = $date->format('Y-m-d');


      $dob = $_REQUEST['dob'];
      $dates = DateTime::createFromFormat('d/m/Y', $dob);
      $mysql_date_dob = $date->format('Y-m-d');
      $phone = $_REQUEST['phone'];
      $gender = $_REQUEST['gender'];
      $department = $_REQUEST['department'];
      $status = $_REQUEST['status'];
      $salary = $_REQUEST['salary'];
      $acc=$_REQUEST['acc_no'];
      $designation=$_REQUEST['designation'];
      $location=$_REQUEST['location'];
      $house_rent=$_REQUEST['house_rent'];
      $tele_bill=$_REQUEST['telephone_bill'];
      $extra=$_REQUEST['extra'];
      $travel=$_REQUEST['travel_allowance'];
      $insentive=$_REQUEST['insentive'];
      $salary_deduction=$_REQUEST['salary_deduction'];
      $gst=$_REQUEST['gst'];
      
      $father_name=$_REQUEST['father_name'];

      
      $insert_query = mysqli_query($connection, "insert into tbl_employee set first_name='$first_name', last_name='$last_name', username='$username', emailid='$emailid', password='$pwd',  dob='$mysql_date_dob', employee_id='$employee_id', joining_date = '$mysql_date_join', gender='$gender', phone='$phone', department='$department', status='$status',salary='$salary',acc_no='$acc',designation='$designation',location='$location',Father_name='$father_name',House_rent='$house_rent',Telephone_bill='$tele_bill',Extra='$extra',Travel_Allowance='$travel',Insentive='$insentive',salary_deduction='$salary_deduction',gst='$gst'");

      if($insert_query>0)
      {
          $msg = "Employee created successfully";
      }
      else
      {
          $msg = "Error!";
      }
    }
?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h4 class="page-title">Add Employee</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="employees.php" class="btn btn-primary btn-rounded float-right">Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                       <form method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="last_name" required> 
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="username" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="emailid" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="pwd" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Employee ID <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="employee_id" value="<?php if(!empty($emp_id)) { echo 'EMP-'.$emp_id; } else { echo "EMP-1"; } ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Joining Date <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" name="joining_date" required>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" name="dob" required>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Salary</label>
                                        <input class="form-control" type="number" name="salary" required>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input class="form-control" type="number" name="acc_no" required>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input class="form-control" type="text" name="designation" required>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input class="form-control" type="text" name="location" required>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input class="form-control" type="text" name="father_name" required>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>House Rent</label>
                                        <input class="form-control" type="number" name="house_rent" >
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Telephone Bill</label>
                                        <input class="form-control" type="number" name="telephone_bill" >
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Extra Allowance</label>
                                        <input class="form-control" type="number" name="extra" >
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Travel Allowance</label>
                                        <input class="form-control" type="number" name="travel_allowance">
                                    </div>
                                 </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Insentive</label>
                                        <input class="form-control" type="number" name="insentive" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Salary deduction</label>
                                        <input class="form-control" type="number" name="salary_deduction" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>GST</label>
                                        <input class="form-control" type="number" name="gst" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" type="text" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group gender-select">
                                        <label class="gen-label">Gender:</label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Male" >Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Female">Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <select class="select" name="department" required>
                                            <option value="">Select</option>
                                            <?php
                                             $fetch_query = mysqli_query($connection, "select department_name from tbl_department where status=1");
                                                while($dept = mysqli_fetch_array($fetch_query)){ 
                                            ?>
                                            <option value="<?php echo $dept['department_name']; ?>"><?php echo $dept['department_name']; ?> </option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label class="display-block">Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="employee_active" value="1" checked>
                                    <label class="form-check-label" for="employee_active">
                                    Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="employee_inactive" value="0">
                                    <label class="form-check-label" for="employee_inactive">
                                    Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="add-employee">Add Employee</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
    
<?php
    include('footer.php');
?>
<script type="text/javascript">
     <?php
        if(isset($msg)) {
            echo 'swal("' . $msg . '");';
        }
    ?>
</script>