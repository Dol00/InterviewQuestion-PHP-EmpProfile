<?php
$filename = "employees.csv";

// Get all input values from the form
$employee_id = $_POST["employee_id"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$marital_status = $_POST["marital_status"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$address = $_POST["address"];
$dob = $_POST["dob"];
$nationality = $_POST["nationality"];
$hire_date = $_POST["hire_date"];
$department = $_POST["department"];

// Check if employee ID already exists
$exists = false;
$rows = [];

if (file_exists($filename)) {
    $file = fopen($filename, "r");
    while (($data = fgetcsv($file)) !== FALSE) {
        if ($data[0] == $employee_id) { // Employee ID is in the first column
            $exists = true;
            break;
        }
        $rows[] = $data;
    }
    fclose($file);
}

// If not exists, add new data
if (!$exists) {
    $file = fopen($filename, "a");

    // If file is empty, add header
    if (filesize($filename) == 0) {
        fputcsv($file, ["Employee ID", "Name", "Gender", "Marital Status", "Phone", "Email", "Address", "Date of Birth", "Nationality", "Hire Date", "Department"]);
    }

    fputcsv($file, [
        $employee_id,
        $name,
        $gender,
        $marital_status,
        $phone,
        $email,
        $address,
        $dob,
        $nationality,
        $hire_date,
        $department
    ]);
    fclose($file);
    header("Location: employees.php");
} else {
    echo "<h2 style='color:red; text-align:center;'>Employee ID '$employee_id' already exists.</h2>";
    echo "<div style='text-align:center; margin-top:20px;'>
            <a href='form.html' style='padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;'>← Back to Form</a>
          </div>";
}
?>