<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);
include "dotenv.php";
include "function.php";


// Connect to MySQL database
$servername = $var_arrs["DB_HOST"];
$username = $var_arrs["DB_USERNAME"];
$password = $var_arrs["DB_PASSWORD"];
$dbname = $var_arrs["DB_DATABASE"];

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$role_id = $_POST["role_id"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$company_name = $_POST["company_name"];
$password1 = $_POST["password"];
$passwordnew = password_hash($password1, PASSWORD_DEFAULT);

$sql = "INSERT INTO registration (first_name, last_name, email, company_name, role_id, password) VALUES ('$first_name', '$last_name', '$email','$company_name','$role_id','$passwordnew')";

if (mysqli_query($conn, $sql)) {
    // duplicate('dbs10633164',$company_name);
    $originalDB = "accountant";
    $newDB = $company_name;
    $result = [];
    $result["message"] = "New record created successfully";

    $host = $servername;
    $user = $username;
    $pass = $password;
    $conn = mysqli_connect($host, $user, $pass);

    if (!$conn) {
        die("Could not connect: " . mysqli_error());
    }

    $db_check = @mysqli_select_db($conn, $originalDB);
    ($getTables = @mysqli_query($conn, "SHOW TABLES")) or
        die(mysqli_error($conn));
    $originalDBs = [];
    while ($row = mysqli_fetch_row($getTables)) {
        $originalDBs[] = $row[0];
    }

    @mysqli_query($conn, "CREATE DATABASE `$newDB`") or
        die(mysqli_error($conn));
    foreach ($originalDBs as $tab) {
        @mysqli_select_db($conn, $newDB) or die(mysqli_error($conn));
        @mysqli_query(
            $conn,
            "CREATE TABLE $tab LIKE " . $originalDB . "." . $tab
        ) or die(mysqli_error($conn));
        @mysqli_query(
            $conn,
            "INSERT INTO $tab SELECT * FROM " . $originalDB . "." . $tab
        ) or die(mysqli_error($conn));
    }
    mysqli_close($conn);

    $connew = mysqli_connect($servername, $username, $password, $newDB);
    $newsql = "INSERT INTO `tblstaff` ( `email`, `firstname`, `lastname`,`password`, `role`) VALUES ( '$email', '$first_name', '$last_name', '$passwordnew', $role_id)";
   
    if (mysqli_query($connew, $newsql)) {
        copy_base_crm($company_name,$var_arrs["BASE_CRM_PATH"],$var_arrs["BASE_PATH"]);

        $str = replace_in_file(
            $var_arrs["BASE_PATH"] .
                $company_name .
                "/application/config/app-config.php",
            "accountant",
            $company_name
        );
        $str = replace_in_file(
            $var_arrs["BASE_PATH"] .
                $company_name .
                "/application/config/app-config.php",
            "http://195.20.239.170/perfex_crm/",
            "http://195.20.239.170/" . $company_name . "/"
        );
        ssh2_exec(
            $connection,
            "sudo chmod -R 664 " .
                $var_arrs["BASE_PATH"] .
                $company_name .
                "/application/config/app-config.php"
        );
        //Mail to customer with link
        registration_mail($email);
    } else {
        //echo "Error: " . $newsql . "<br>" . mysqli_error($connew);
    }

    $result["status"] = true;

    echo json_encode($result);
} else {
    $result = [];
    $result["message"] = mysqli_error($conn);
    $result["status"] = false;
    echo json_encode($result);
}

?>
