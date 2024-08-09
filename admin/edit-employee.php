<?php 
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');

$id = $_GET['id'];

$fetch_query = mysqli_query($connection, "select * from tbl_employee where id='$id'");
$row = mysqli_fetch_array($fetch_query);

if(isset($_REQUEST['save-emp']))
{
      $first_name = $_REQUEST['first_name'];
      $last_name = $_REQUEST['last_name'];
      $username = $_REQUEST['username'];
      $emailid = $_REQUEST['emailid'];
      $pwd = $_REQUEST['pwd'];
      // $joining_date = $_REQUEST['joining_date'];
      //  // $date = DateTime::createFromFormat('d/m/Y', $joining_date);
      // $mysql_date_join = $date->format('Y-m-d');
      //   $dob = $_REQUEST['dob'];
      //   // $dates = DateTime::createFromFormat('d/m/Y', $dob);
      // $mysql_date_dob = $date->format('Y-m-d');
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


      $update_query = mysqli_query($connection, "update tbl_employee set first_name='$first_name', last_name='$last_name', username='$username', emailid='$emailid', password='$pwd', gender='$gender', phone='$phone',   department='$department', status='$status', salary='$salary',acc_no='$acc',designation='$designation',location='$location',Father_name='$father_name',House_rent='$house_rent',Telephone_bill='$tele_bill',Extra='$extra',Travel_Allowance='$travel',Insentive='$insentive',salary_deduction='$salary_deduction',gst='$gst' where id='$id'");
      if($update_query>0)
      {
          $msg = "Employee updated successfully";
          $fetch_query = mysqli_query($connection, "select * from tbl_employee where id='$id'");
          $row = mysqli_fetch_array($fetch_query);   
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
                        
                        <h4 class="page-title">Edit Employee</h4>
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
                                        <input class="form-control" type="text" name="first_name" value="<?php  echo $row['first_name'];  ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="last_name" value="<?php echo $row['last_name']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="username" value="<?php echo $row['username']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="emailid" value="<?php echo $row['emailid']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="pwd" value="<?php echo $row['password']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Employee ID <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="employee_id" value="<?php echo $row['employee_id']; ?>" disabled>
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Joining Date <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" value="<?php echo date('d/m/Y', strtotime($row['joining_date'])); ?>" disabled>
                                            <input type="hidden" name="joining_date" value="<?php echo $row['joining_date']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" value="<?php echo date('d/m/Y', strtotime($row['dob'])); ?>" disabled>
                                            <input type="hidden" name="dob" value="<?php echo $row['dob']; ?>">
                                 
                                            
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Salary</label>
                                        <input class="form-control" type="number" name="salary" value="<?php echo $row['salary'];?>"required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Account Number</label>
                                        <input class="form-control" type="number" name="acc_no" value="<?php echo $row['acc_no'];?>" required>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input class="form-control" type="text" name="designation" value="<?php echo $row['designation'];?>" required>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input class="form-control" type="text" name="location" value="<?php echo $row['location'];?>" required>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Father Name</label>
                                        <input class="form-control" type="text" name="father_name" value="<?php echo $row['Father_name'];?>" required>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>House Rent</label>
                                          <input class="form-control" type="number" name="house_rent" value="<?php echo $row['House_rent'];?>" >
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Telephone Bill</label>
                                        <input class="form-control" type="number" name="telephone_bill" value="<?php echo $row['Telephone_bill'];?>">
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Extra Allowance</label>
                                        <input class="form-control" type="number" name="extra" value="<?php echo $row['Extra'];?>">
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Travel Allowance</label>
                                        <input class="form-control" type="number" name="travel_allowance" value="<?php echo $row['Travel_Allowance'];?>">
                                    </div>
                                 </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Insentive</label>
                                        <input class="form-control" type="number" name="insentive" value="<?php echo $row['Insentive'];?>">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Salary deduction</label>
                                        <input class="form-control" type="number" name="salary_deduction"value="<?php echo $row['salary_deduction'];?>" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>GST</label>
                                        <input class="form-control" type="number" name="gst" value="<?php echo $row['gst'];?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" type="text" name="phone" value="<?php echo $row['phone']; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group gender-select">
                                        <label class="gen-label">Gender:</label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Male" <?php if($row['gender']=='Male') { echo 'checked' ; } ?>>Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Female" <?php if($row['gender']=='Female') { echo 'checked' ; } ?>>Female
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
                                             $fetch_query = mysqli_query($connection, "select department_name from tbl_department");
                                                while($dept = mysqli_fetch_array($fetch_query)){ 
                                            ?>
                                            <option <?php if($row['department']==$dept['department_name']) { ?>selected="selected";<?php } ?>><?php echo $dept['department_name']; ?> </option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>

                                </div>
							
                            <div class="form-group">
                                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="emp_active" value="1" <?php if($row['status']==1) { echo 'checked' ; } ?>>
									<label class="form-check-label" for="employee_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="emp_inactive" value="0" <?php if($row['status']==0) { echo 'checked' ; } ?>>
									<label class="form-check-label" for="employee_inactive">
									Inactive
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="save-emp">Save</button>
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