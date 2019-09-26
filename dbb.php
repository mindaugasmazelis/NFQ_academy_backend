<?php
 
$dsn = "pgsql:host=ec2-176-34-237-141.eu-west-1.compute.amazonaws.com;port=5432;dbname=deidpi6hnpftje;user=itczvsidrsyugu;password=3183ca97d7c7845c94157b80b69072938ea71b5c701e8dac687aa8787ffce8c8";
 
try{
 // create a PostgreSQL database connection
 $conn = new PDO($dsn);
 
 // display a message if connected to the PostgreSQL successfully
 if($conn){
 echo "Connected to the <strong>$db</strong> database successfully!";
 }
}catch (PDOException $e){
 // report error message
 echo $e->getMessage();


// Query priskiria 6 skaitenų int, kuris būtų pateikiamas vartotojui kaip "reference number"
$query = "CREATE TABLE customer_list (customer_name varchar(50),reference_number int(6),time_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

if ($conn->query($query)) {
	echo "Payload delivered successfully: <br>   ".$query."<br><br>";
}
else {
	echo "There was an error <br>";
}
?>