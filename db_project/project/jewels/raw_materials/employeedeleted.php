<html>
<title>Delete Employee</title>
<head>
<a href="./addemployee.php">insert</a>
<a href="./getemployeeinfo.php">backtodb</a>

<br>
</head>
<body>
<form action="http://localhost/project/jewels/employee/employeedeleted.php" method="post">

<b>Delete a New Employee</b>

<p>Employee_ID:
<input type="text" name="employee_id" size="50" value="" />
</p>

<p>
<input type="submit" name="submit" value="Send" />
</p>

</form>

<?php
require_once('../../mysqli_connect.php');

if(isset($_POST['employee_id'])){

    $data_missing = array();

    if(empty($_POST['employee_id'])){

        // Adds name to array
        $data_missing[] = 'employee_id';

    } else {

        // Trim white space from the name and store the name
        $employee_id = trim($_POST['employee_id']);

    }

 if(empty($data_missing)){

        //require_once('../mysqli_connect.php');

        $query = "DELETE FROM employee WHERE employee_id = $employee_id";


	mysqli_query($dbc, $query);


        $affected_rows = mysqli_affected_rows($dbc);

        if($affected_rows == 1){

            echo 'Employee Deleted';

	    //unset($dbc);
           // mysqli_close($dbc);

        } else {

            echo 'Error Occurred<br />';

            echo mysqli_error($dbc);

             mysqli_close($dbc);

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
$query = "SELECT employee_id, name, phone_no, address_id, salary, DOB, age FROM employee";

// Get a response from the database by sending the connection
// and the query
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if($response){

echo '<table align="left"
cellspacing="5" cellpadding="8">

<tr><td align="left"><b>employee_id</b></td>
<td align="left"><b>name</b></td>
<td align="left"><b>phone_no</b></td>
<td align="left"><b>address_id</b></td>
<td align="left"><b>salary</b></td>
<td align="left"><b>DOB</b></td>
<td align="left"><b>age</b></td></tr>';

// mysqli_fetch_array will return a row of data from the query
// until no further data is available
while($row = mysqli_fetch_array($response)){

echo '<tr><td align="left">' .
$row['employee_id'] . '</td><td align="left">' .
$row['name'] . '</td><td align="left">' .
$row['phone_no'] . '</td><td align="left">' .
$row['address_id'] . '</td><td align="left">' .
$row['salary'] . '</td><td align="left">' .
$row['DOB'] . '</td><td align="left">' .
$row['age'] . '</td><td align="left">';

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


</html>



</html>
