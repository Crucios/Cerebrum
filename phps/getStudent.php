<?php 
require_once "connect.php";
$classid = $_POST["classid"];
$id = $_POST['id'];
$querycheck = mysqli_query($conn, "SELECT * FROM users u JOIN class_details cd ON u.id = cd.users_id WHERE cd.users_id = $id AND cd.class_id = $classid");
$resultcheck = mysqli_fetch_array($query);
$role = $resultcheck['role'];
if ($role == 1) {
	$roletostring = "creator";
}
else if ($role == 3) {
	$roletostring = "student";
}
else if ($role == 2) {
	$roletostring = "teacher";
}
$query = mysqli_query($conn, "SELECT * FROM users u JOIN class_details cd ON u.id = cd.users_id WHERE cd.class_id = $classid AND role = 3 ORDER BY u.username ASC");
echo "<?xml version='1.0' encoding='UTF-8'?>\n";
echo "<data>\n";

if(!empty($query)){
	while($row = mysqli_fetch_array($query)){
		if ($row['role'] == 1) {
			if ($row['status'] == 1) {
				echo "<member id='".$row["id"]."'>\n";
				echo "<username>".$row["username"]."</username>\n";
				echo "<nickname>".$row["nickname"]."</nickname>\n";
				echo "<role>Creator</role>\n";
				echo "<session>".$roletostring."<session>";
				echo "<status>".$row["status"]."</status>\n";
				echo "</member>\n";
			}

		}
		else if ($row['role'] == 2) {
			if ($row['status'] == 1) {
				echo "<member id='".$row["id"]."'>\n";
				echo "<username>".$row["username"]."</username>\n";
				echo "<nickname>".$row["nickname"]."</nickname>\n";
				echo "<role>Teacher</role>\n";
				echo "<session>".$roletostring."<session>";
				echo "<status>".$row["status"]."</status>\n";
				echo "</member>\n";
			}
		}
		else if ($row['role'] == 3) {
			if ($row['status'] == 1) {
				echo "<member id='".$row["id"]."'>\n";
				echo "<username>".$row["username"]."</username>\n";
				echo "<nickname>".$row["nickname"]."</nickname>\n";
				echo "<role>Student</role>\n";
				echo "<session>".$roletostring."<session>";
				echo "<status>".$row["status"]."</status>\n";
				echo "</member>\n";
			}
		}

	}
}
echo "</data>";

mysqli_close($conn);
?>