<?php

$servername = "localhost";
$username = "root";
$password = "";
$DBname = "my_test_db";

$conn = mysqli_connect($servername, $username, 
	$password, $DBname);

$entered_name = mysqli_real_escape_string($conn, $_REQUEST['customer_name']);

if ($conn){
	echo "Connected successfully <br>";
}
else {
	echo "connection error <br><br>".mysqli_connect_error();
}

echo 'Entered_name: '.$entered_name."<br>";

$query = "INSERT INTO customer_list (customer_name,reference_number) VALUES ('$entered_name',FLOOR(RAND()*1000000)+1)";


// $query = '';

if (mysqli_query($conn,$query)) {
	echo "Payload delivered successfully: <br>   ".$query."<br><br>";
	$last_id = mysqli_insert_id($conn);
	echo 'Database id: '.$last_id.'<br>';
}
else {
	echo "There was an error <br>".mysqli_error($conn)."<br>";
}

// 
// 
$query = "SELECT * FROM customer_list where id = '$last_id';";

$result = mysqli_query($conn,$query);
$reg_time = $result->fetch_assoc()["time_registered"];
$result = mysqli_query($conn,$query);
$ref_num = $result->fetch_assoc()["reference_number"];
echo 'Registration time: '.$reg_time."<br>";
echo 'Reference number: '.$ref_num."<br><br>";


// 
// 

mysqli_close($conn);
?>


<html>
   <head>
      <title>JavaScript Dates</title>
   </head>
   <body>
   	<p id='JS_demo2'>Time now: </p>
   	<p id='JS_demo_diff'>Elapsed time: </p>
      <script>  

      	var x = setInterval(function(){

        var date1;  
        date1 = "<?php echo $reg_time ?>";


        var date;
		date = new Date();
		date = date.getUTCFullYear() + '-' +
    	('00' + (date.getUTCMonth()+1)).slice(-2) + '-' +
    	('00' + date.getUTCDate()).slice(-2) + ' ' + 
    	('00' + date.getHours()).slice(-2) + ':' + 
    	('00' + date.getUTCMinutes()).slice(-2) + ':' + 
    	('00' + date.getUTCSeconds()).slice(-2);
		// console.log(date);
        // document.write("date2: "+date);
        document.getElementById("JS_demo2").innerHTML = "Time now: "+ date

        var diff_minutes = date.split(":")[1]-date1.split(":")[1];
        var diff_seconds = date.split(":")[2]-date1.split(":")[2];
        var diff_hours = date.split(":")[0].split(" ")[1]-date1.split(":")[0].split(" ")[1];

        var diff = ("00"+diff_hours).slice(-2)+":"+("00"+diff_minutes).slice(-2)+":"+("00"+diff_seconds).slice(-2);

        document.getElementById("JS_demo_diff").innerHTML = "Elapsed time: "+diff

    },1000)
      </script>
      <form method='GET' action="input_screen.php">
      <button type="submit">Enter another record</button>
      </form>
   </body>
</html>