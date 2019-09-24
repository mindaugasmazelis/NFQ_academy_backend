<?php
$url = "localhost";
$username = "root";
$password = "";
$database = "my_test_db";

$connection = new mysqli($url,$username,$password,$database);

if ($connection->connect_error) {
	echo "connection error: ".$connection->connect_error;
}
else{
	echo "Connected successfully to the server <br>";
}

// patikrina kiek duombazėje eilučių
$sql = "SELECT * FROM customer_list";
$result = $connection->query($sql);
// patikrina kiek duombazėje eilučių


// Jei duombezės eilučių daugiau nei 0
if ($result->num_rows > 0) {

    $counter = 0;
    while($row = $result->fetch_assoc())
     {
        // Loop per visas duombazės eilutes
        // Įterpiamas HTML blokas sukurti mygtukus, perduodant value, kaip DB "id" ir ONSUBMIT iškviečiant javascript scriptą (apačioje)
?>

    <form method="POST" action="" onsubmit="setTimeout(function () { window.location.reload(true); }, 10)">
    <button type="submit" name="data" value=<?php echo $row["id"]; ?>>
    Delete
    </button>

<?php 
        
        // Jei submitinus mygtuką yra priskiriami $_POST['data'] duomenys, siunčiamas SQL query trinti mygtuko value nurodytą "id"

        if(isset($_POST['data'])){
            $value = $_POST['data'];
            $sth = $connection->prepare("DELETE FROM `customer_list` WHERE `customer_list`.`id` = $value;");
            $sth->execute();
        }
        // Spausdinamos eilutės informacija iš duombazės
    	$counter++;
        echo $counter." -- Id: " . $row["id"]. " Name: " . $row["customer_name"]. " " . $row["time_registered"]."<br>";
    }}

$connection->close();

?>

<!-- Forma uždaroma tik čia, nes taip tvarkingesnis eilučių formatavimas -->
</form>