<?php
$filename = "employees.csv";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #aaa;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .back-button {
            text-align: center;
            margin-top: 30px;
        }
        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-family: sans-serif;
        }
        .back-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Employee List</h2>
    <table>
        <?php
        if (file_exists($filename) && filesize($filename) > 0) {
            $file = fopen($filename, "r");
            $isHeader = true;
            while (($data = fgetcsv($file)) !== FALSE) {
                echo "<tr>";
                foreach ($data as $cell) {
                    echo $isHeader ? "<th>$cell</th>" : "<td>$cell</td>";
                }
                echo "</tr>";
                $isHeader = false;
            }
            fclose($file);
        } else {
            echo "<tr><td colspan='11' style='text-align:center;'>No employee records found.</td></tr>";
        }
        ?>
    </table>

    <div class="back-button">
        <a href="form.html">← Back to Form</a>
    </div>
</body>
</html>