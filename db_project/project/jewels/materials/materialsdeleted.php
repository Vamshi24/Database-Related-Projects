<html>
<?php
session_start();
if(!isset($_SESSION['myusername']) || $_SESSION['myusername'] == "cashier")
{
echo("login unsccessfull");
header("location: http://localhost/project/jewels/login/main_login.php");
}
?>

<head>
<?php
echo '<div style="margin:10px 10px 10px 1100px ;">';
echo '<p style="text-align: left; width:150px;">';
echo  "usertechnical_name:" . $_SESSION['myusername'] ;
echo "</p>";
echo ' <a href=" http://localhost/project/jewels/login/logout.php" style="text-align:right;">logout</a> ' ;
echo "</div>";
?>
<title>Project</title>
</head>
<body style="background-image:url('../image.jpg');background-attachment:fixed;background-repeat:no repeat;background-size:cover;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;">
<div style="margin: 10px 10px 10px ; position: absolute;">
<br/>
<a href="http://localhost/project/jewels/employee/getemployeeinfo.php">Employee</a>
<br/><br/>
<a href="http://localhost/project/jewels/customer/getcustomerinfo.php">Customer</a>
<br/><br/>
<a href="http://localhost/project/jewels/cashier/getcashierinfo.php">Cashier</a>
<br/><br/>
<a href="http://localhost/project/jewels/gold_smith/getgoldsmithinfo.php">Goldsmith</a>
<br/><br/>
<a href="http://localhost/project/jewels/jewellery_shop/getjewelleryshopinfo.php">JewelleryShop</a>
<br/><br/>
<a href="http://localhost/project/jewels/materials/getmaterialsinfo.php">Materials</a>
<br/><br/>
<a href="http://localhost/project/jewels/payment/getpaymentinfo.php">Payment</a>
<br/><br/>
<a href="http://localhost/project/jewels/sale/getsaleinfo.php">Sales</a>
<br/><br/>
<a href="http://localhost/project/jewels/security/getsecurityinfo.php">Security</a>
<br/><br/>
<a href="http://localhost/project/jewels/order/getorderinfo.php">Order</a>
<br/><br/>
<a href="http://localhost/project/jewels/supplier/getsupplierinfo.php">Supplier</a>
</div>
<div style="width: 1000px; margin-left: 160px; margin-top: 10px; position: absolute; top: 100px;"><a href="./addmaterials.php">insert</a>
<a href="./getmaterialsinfo.php">backtodb</a>

<form action="http://localhost/project/jewels/materials/materialsdeleted.php" method="post">

<b>Delete a New materials</b>

<p>category_id:
<input type="text" name="category_id" size="50" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>

<?php
require_once('../../mysqli_connect.php');

if(isset($_POST['category_id'])){

    $data_missing = array();

    if(empty($_POST['category_id'])){

        // Adds technical_name to array
        $data_missing[] = 'category_id';

    } else {

        // Trim white space from the technical_name and store the technical_name
        $category_id = trim($_POST['category_id']);

    }

 if(empty($data_missing)){

        //require_once('../mysqli_connect.php');

        $query = "DELETE FROM materials WHERE category_id = $category_id";


	mysqli_query($dbc, $query);


        $affected_rows = mysqli_affected_rows($dbc);

        if($affected_rows == 1){

            echo 'materials Deleted';

	    //unset($dbc);
           // mysqli_close($dbc);

        } else {

            echo 'Error Occurred<br />';

            echo mysqli_error($dbc);

             //mysqli_close($dbc);

        }

    } else {

        echo 'You need to enter the following data<br />';

        foreach($data_missing as $missing){

            echo "$missing<br />";

        }

    }

}


echo "<br />";
//unset($dbc);

// Get a connection for the database
//require_once('../mysqli_connect.php');

// Create a query for the database
$query = "SELECT category_id, technical_name, composition FROM materials";

// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if($response){

echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr><td align="left"><b>category_id</b></td>
<td align="left"><b>technical_name</b></td>
<td align="left"><b>composition</b></td>
</tr>';

// mysqli_fetch_array will return a row of data from the query
// until no further data is available
while($row = mysqli_fetch_array($response)){

echo '<tr><td align="left">' .
$row['category_id'] . '</td><td align="left">' .
$row['technical_name'] . '</td><td align="left">' .
$row['composition'] . '</td><td align="left">';


echo '</tr>';
}

echo '</table>';

} else {

echo "Couldn't issue database query<br />";

echo mysqli_error($dbc);

}

// Close connection to the database
mysqli_close($dbc);

?>


</div>
</body>
</html>
