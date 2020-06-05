<?php 

require_once "connect.php";

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Jessica', 'White', 'jess@example.com')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>