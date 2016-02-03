<html>
<?php
session_start();
if(!isset($_SESSION['myusername']) || $_SESSION['myusername'] != "cashier")
{
echo("login unsccessfull");
header("location: http://localhost/project/jewels/login/main_login.php");
}
?>

<head>
<?php
echo '<div style="margin:10px 10px 10px 1100px ;">';
echo '<p style="text-align: left; width:150px;">';
echo  "username:" . $_SESSION['myusername'] ;
echo "</p>";
echo ' <a href=" http://localhost/project/jewels/login/logout.php" style="text-align:right;">logout</a> ' ;
echo "</div>";
require_once('../../mysqli_connect.php');
?>
<title>Project</title>
</head>
<body style="background-image:url('image.jpg');background-attachment:fixed;background-repeat:no repeat;background-size:cover;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;">
<div style="margin: 10px 10px 10px ; position: absolute;">
<br/>
<a href="http://localhost/project/jewels/gold_smith1/getgoldsmithinfo.php">Goldsmith</a>
<br/>
<br/>
<a href="http://localhost/project/jewels/materials1/getmaterialsinfo.php">Materials</a>
<br/>
<br/>
<a href="http://localhost/project/jewels/payment1/paymentadded.php">Payment</a>
<br/>
<br/>
<a href="http://localhost/project/jewels/sale1/saleadded.php">Sales</a>
<br/>
<br/>
</div>
<div style="width: 1000px; margin-left: 160px; margin-top: 10px; position: absolute; top: 100px;"><?php

if(isset($_POST['submit'])){
    
    $data_missing = array();
    

    if(empty($_POST['cashier_id'])){

        // Adds name to array
        $data_missing[] = 'cashier_id';

    } else{

        // Trim white space from the name and store the name
        $cashier_id = trim($_POST['cashier_id']);

    }

    if(empty($_POST['payment_status'])){

        // Adds name to array
        $data_missing[] = 'payment_status';

    } else {

        // Trim white space from the name and store the name
        $payment_status = trim($_POST['payment_status']);

    }

    if(empty($_POST['amount_given'])){

        // Adds name to array
        $data_missing[] = 'amount_given';

    } else {

        // Trim white space from the name and store the name
        $amount_given = trim($_POST['amount_given']);

    }

    if(empty($_POST['change_returned'])){

        // Adds name to array
        $data_missing[] = 'change_returned';

    } else {

        // Trim white space from the name and store the name
        $change_returned = trim($_POST['change_returned']);

    }
    
    if(empty($data_missing)){
        
//        require_once('../../mysqli_connect.php');
        
        $query = "INSERT INTO payment (payment_id, cashier_id, payment_status, amount_given,
        change_returned) VALUES (NULL, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($dbc, $query);
        
        
        mysqli_stmt_bind_param($stmt, "isii", $cashier_id,
                               $payment_status, $amount_given, $change_returned);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_stmt_affected_rows($stmt);
        
        if($affected_rows == 1){
            
            echo 'Employee Entered';
            
            mysqli_stmt_close($stmt);
            
            mysqli_close($dbc);
            
        } else {
            
            echo 'Error Occurred<br />';
            echo mysqli_error();
            
            mysqli_stmt_close($stmt);
            
            mysqli_close($dbc);
            
        }
        
    } else {
        
        echo 'You need to enter the following data<br />';
        
        foreach($data_missing as $missing){
            
            echo "$missing<br />";
            
        }
        
    }
    
}

?>


<form action="http://localhost/project/jewels/payment/paymentadded.php" method="post">

<b>Add a New Payment</b>


<p>cashier_id:
<input type="text" name="cashier_id" size="11" value="" />
</p>

<p>payment_status:
<input type="text" name="payment_status" size="10" value="" />
</p>

<p>amount_given:
<input type="text" name="amount_given" size="9" value="" />
</p>

<p>change_returned:
<input type="text" name="change_returned" size="6" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>
</div>
</body>
</html>
