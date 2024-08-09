<?php
session_start();
error_reporting(0);
if (empty($_SESSION['name'])) {
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
$id = $_SESSION['id'];
$fetch_query = mysqli_query($connection, "SELECT shift FROM tbl_employee WHERE id='$id'");

$fetch_emp = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE id='$id'");
$emp = mysqli_fetch_array($fetch_emp);
$empid = $emp['employee_id'];
$dept = $emp['department'];

$curr_date = date('Y-m-d');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    $dept = $_POST['department'];
    $date = date('Y-m-d');
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    if (!empty($latitude) && !empty($longitude)) {
        $sql = "INSERT INTO tbl_attendance (employee_id, department, date, latitude, longitude) VALUES ('$employee_id', '$dept', '$date', '$latitude', '$longitude')";
        if ($connection->query($sql) === TRUE) {
            $err = "Attendance recorded successfully";
        } else {
            $err = "Error: " . $sql . "<br>" . $connection->error;
        }
    } else {
        $err = "Error: Latitude or Longitude not set.";
    }
}
?>
<div class="page-wrapper ">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Attendance Form</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2 ">
                <?php
                $sql = mysqli_query($connection, "SELECT * FROM tbl_attendance WHERE employee_id='$empid' AND date='$curr_date'");
                if (mysqli_num_rows($sql) == 0) {
                ?>
                <form id="attendanceForm" method="POST" action="">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Employee ID <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="<?php echo $empid; ?>" disabled>
                                <input class="form-control" type="hidden" name="employee_id" value="<?php echo $empid; ?>">
                            </div>
                            <div class="form-group">
                                <label>Branch Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" value="<?php echo $dept; ?>" disabled>
                                <input class="form-control" type="hidden" name="department" value="<?php echo $dept; ?>">
                            </div>
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button type="button" class="btn btn-primary submit-btn" onclick="getLocation()">Turn It!</button>
                    </div>
                </form>
                <?php
                } else {
                    echo " <h4>You have already submitted your attendance. See you again!</h4>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container  text-right">
        <button class="btn btn-success justify-content-center"  id="download">Download My PaySlip</button>
    </div>

    
<div id="payslipdownload">
<div class="container  mr-5 mb-3" >
    <div class="row">
        <div class="col-md-12">
            <div class="text-center lh-1 mb-2 ">
                <img src="assets/img/logo.jpg"  style="width:80px;height:80px;position:relative;"> 
            </div>
                <div class="text-center h3 mb-2 ">
                 <span class="text-dark " >Ishvaryam Womens Fortune Foundation</span>
            </div>
            <div class="table-responsive mt-5">
<?php
$fetch_emp = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE id='$id'");
$emp = mysqli_fetch_array($fetch_emp);
$empid=$emp['employee_id'];
$name=$emp['first_name'] ." ".$emp['last_name'];
$dateofjoining=$emp['joining_date'];
$dept=$emp['department'];
$email=$emp['emailid'];
$phone=$emp['phone'];
$salary=$emp['salary'];
$acc_no=$emp['acc_no'];
$designation=$emp['designation'];
$emp_type=$emp['employee_type'];
$location=$emp['location'];
$father_name=$emp['Father_name'];
$house_rent=$emp['House_rent'];
$telephone_bill=$emp['Telephone_bill'];
$extra=$emp['Extra'];
$travel=$emp['Travel_Allowance'];
$insentive=$emp['Insentive'];
$salary_deduction=$emp['salary_deduction'];
$gst=$emp['gst'];
$total_deduction=$salary_deduction+$gst;
$totalsalary=($salary+$house_rent+$telephone_bill+$extra+$travel+$insentive)-($total_deduction);
$salary_into_word=numberToWords($totalsalary);
// $from_date='2024-07-22';
// $to_date='2024-07-31';

// ///present count
// $first_day_of_prev_month = date('Y-m-01', strtotime('first day of last month'));
// $last_day_of_prev_month = date('Y-m-t', strtotime('last day of last month'));
$from_date = date('Y-m-01', strtotime('first day of last month'));
$to_date = date('Y-m-t', strtotime('last day of last month'));
$from_date = mysqli_real_escape_string($connection, $from_date);
$to_date = mysqli_real_escape_string($connection, $to_date);
$empid = mysqli_real_escape_string($connection, $empid); 

// Assuming $empid is defined and properly sanitized
// Example of basic sanitization

// Corrected SQL query
$search_query = mysqli_query($connection, "SELECT COUNT(date) AS present_days FROM tbl_attendance WHERE employee_id = '$empid' AND date BETWEEN '$from_date' AND '$to_date'");


if ($search_query) {
    $present_count = mysqli_fetch_array($search_query);
    $present = $present_count['present_days'];
    // echo "Present days: " . $present;
} else {
    // Handle query error
    // echo "Error: " . mysqli_error($connection);
}
?>
<?php

function numberToWords($number) {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'forty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'numberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . numberToWords(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . numberToWords($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = numberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= numberToWords($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

// Example usage
//echo numberToWords(123456); // Output: one hundred and twenty-three thousand, four hundred and fifty-six
?>
                
            </div>
            <table class="table table-bordered " >
            <div class="d-flex justify-content-end"> <span></span> </div>
             <div class="d-flex flex-column">
            <div class="row">
                <div class="col-md-12" style="border: 1px solid gray;color: black;">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4 ">Emplyee name</span> <small class="ms-3 " ><?php echo "$name";?></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Employee Id</span> <small class="ms-3"><?php echo $empid;?></small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Bank Account No</span> <small class="ms-3"><?php echo $acc_no;?></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Father Name</span> <small class="ms-3"><?php echo $father_name;?></small> </div>
                          </div>
                    </div>
                                        <div class="row">
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Designation</span> <small class="ms-3"><?php echo $designation?></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Employee Type</span> <small class="ms-3"><?php echo $emp_type; ?></small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Date of Joining</span> <small class="ms-3"><?php echo "$dateofjoining";?></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Pay Slip For</span> <small class="ms-3"><?php if (!empty($from_date) && DateTime::createFromFormat('Y-m-d', $from_date) !== false) {$date = new DateTime($from_date);
    $month = $date->format('F');
    $year = $date->format('Y');
    
    echo $month." ".$year;}?></small> </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Branch Name</span> <small class="ms-3"><?php echo "$dept";?></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Email</span> <small class="ms-3"><?php echo $email; ?></small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Phone Number</span> <small class="ms-3"><?php echo "$phone";?></small> </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Location</span> <small class="ms-3"><?php echo $location;?></small> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row"> <span class="fw-bolder col-4">Days Worked</span> <small class="ms-3"><?php echo $present;?></small> </div>
                        </div>
                        
                    </div>
                </table>
                </div>
            </div>
                <table class="mt-3 table table-bordered">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th scope="col">Earnings</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Deductions</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Basic Salary</th>
                            <td><?php echo $salary;?>.00</td>
                            <td>Salary Deduction</td>
                            <td><?php echo $salary_deduction?></td>
                        </tr>
                        <tr>
                            <th scope="row">House Rent Allowance</th>
                            <td><?php echo $house_rent;?>.00</td>
                            <td>GST</td>
                            <td><?php echo $gst;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Telephone Bill Allowance</th>
                            <td><?php echo $telephone_bill;?>.00</td>
                            
                        </tr>
                        <tr>
                            <th scope="row">Extra Allowance</th>
                            <td><?php echo $extra;?></td>
                            
                        </tr>
                        <tr>
                            <th scope="row">Travel Allowance</th>
                            <td><?php echo $travel;?>.00</td>
                            
                        </tr>
                        <tr>
                            <th scope="row">Insentive</th>
                            <td><?php echo $insentive;?>.00</td>
                            
                        </tr>
                        
                        
                         <tr class="border-top">
                            <th scope="row">Total Earning</th>
                            <td><?php echo $totalsalary;?>.00</td>
                            <td>Total Deductions</td>
                            <td><?php echo $total_deduction;?>.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-3 text-center"> <br> <span class="text-dark" style="margin-right: 1px;position: relative;">Net Pay : <?php echo "$totalsalary";?> .00<span> </div><br>
                <div class="border col-md-6">
                    <div class="d-flex flex-column text-dark"> <span>In Words</span> <span class="text-center "><?php echo $salary_into_word;?> only</span> </div>
                </div>
            </div>
            <div class="d-flex justify-content-end text-dark">
                <div class="d-flex flex-column mt-2"> <span class="fw-bolder">Ishwaryam Womens<br> Fortune Fundation</span> <span class="mt-4">Authorised Signatory</span> </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('footer.php'); ?>

<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    document.getElementById("latitude").value = position.coords.latitude;
    document.getElementById("longitude").value = position.coords.longitude;
    document.getElementById("attendanceForm").submit();
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
   
<script type="text/javascript">
     <?php
        if(isset($err)) {
              echo 'swal("' . $err . '");';
          }
     ?>
     document.getElementById('download').addEventListener('click', function () {
            var element = document.getElementById('payslipdownload');
            html2pdf().from(element).set({
                margin: 0.5,
                filename: 'myfile.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 1 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            }).save();
        });
       

     
</script> 
