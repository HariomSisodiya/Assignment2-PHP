<?php
$servername = 'localhost';
$username = 'Hariom';
$password = '';
$dbname = 'userlogin';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

// Execute query and fetch results
$result = mysqli_query($conn, "SELECT * FROM user");

// Prepare HTML for Excel
$html = '<table border="1"><tr><th>Sr.</th><th>Username</th><th>Email</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    $html .= "<tr><td>{$row['Id']}</td><td>{$row['Username']}</td><td>{$row['Email']}</td></tr>";
}
$html .= '</table>';

// Output as Excel file
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="report.xls"');
echo $html;

mysqli_close($conn);
?>
