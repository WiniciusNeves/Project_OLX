<?php
$con = mysqli_connect("127.0.0.1:3307", "root", "");
$database = mysqli_select_db($con, "project_olx");

/*if (!$con || !mysqli_select_db($con, 'project_olx')) {
    die('Could not connect to database');
} else {
    echo "Connected to database";
}*/

