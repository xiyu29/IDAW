<?php

require_once('check_connexion.php');

// inquire of data exp in the table 'tranche_age'
$sql = "SELECT * FROM tranche_age";
$result = $conn->query($sql);

// check if the inquire is succeed
if ($result->num_rows > 0) {
    // show data
    while($row = $result->fetch_assoc()) {
        echo "tranche age: " . $row["tr_age"] . "<br>";
    }
} else {
    echo "0 results";
}

// shut down connexion
$conn->close();

?>