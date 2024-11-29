<?php
// Database connection
$host = 'localhost';
$dbname = 'payroll_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


function calculatePayroll($basicSalary, $workingDays, $overtimeHours, $sss, $philhealth, $pagibig, $tax) {

    $dailyRate = $basicSalary / 22;

    $overtimePay = ($dailyRate / 8) * $overtimeHours * 1.25;


    $grossPay = $basicSalary + $overtimePay;


    $totalDeductions = $sss + $philhealth + $pagibig + $tax;

    
    $netPay = $grossPay - $totalDeductions;

    return [$grossPay, $totalDeductions, $netPay];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $basicSalary = $_POST['basic_salary'];
    $workingDays = $_POST['working_days'];
    $overtimeHours = $_POST['overtime_hours'];
    $sss = $_POST['sss'];
    $philhealth = $_POST['philhealth'];
    $pagibig = $_POST['pagibig'];
    $tax = $_POST['tax'];

   
    list($grossPay, $totalDeductions, $netPay) = calculatePayroll($basicSalary, $workingDays, $overtimeHours, $sss, $philhealth, $pagibig, $tax);


    $stmt = $pdo->prepare("INSERT INTO employees (name, position, basic_salary, working_days, overtime_hours, sss, philhealth, pagibig, tax, gross_pay, total_deductions, net_pay)
                           VALUES (:name, :position, :basic_salary, :working_days, :overtime_hours, :sss, :philhealth, :pagibig, :tax, :gross_pay, :total_deductions, :net_pay)");
    
    $stmt->execute([
        ':name' => $name,
        ':position' => $position,
        ':basic_salary' => $basicSalary,
        ':working_days' => $workingDays,
        ':overtime_hours' => $overtimeHours,
        ':sss' => $sss,
        ':philhealth' => $philhealth,
        ':pagibig' => $pagibig,
        ':tax' => $tax,
        ':gross_pay' => $grossPay,
        ':total_deductions' => $totalDeductions,
        ':net_pay' => $netPay
    ]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 300px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            padding-right: 50px;
            border-radius: 10px;
            width: 500px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"], input[type="number"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

        button {
            margin-top: 20px;
            padding: 15px;
            background-color: #ff4757;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e84118;
        }

        .results {
            background-color: #f1f2f6;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            text-align:center;
        }

        .results p {
            margin: 5px 0;
            font-size: 16px;
        }

        .results h2 {
            color: #2f3640;
            font-size: 20px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payroll Calculator</h1>
        <form action="" method="POST">
            <label for="name">Employee Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="position">Position:</label>
            <input type="text" id="position" name="position" required>

            <label for="basic_salary">Basic Salary:</label>
            <input type="number" id="basic_salary" name="basic_salary" required>

            <label for="working_days">Number of Working Days:</label>
            <input type="number" id="working_days" name="working_days" value="22" readonly>

            <label for="overtime_hours">Overtime Hours:</label>
            <input type="number" step="0.01" id="overtime_hours" name="overtime_hours">

            <label for="sss">SSS Contribution:</label>
            <input type="number" step="0.01" id="sss" name="sss" required>

            <label for="philhealth">PhilHealth Contribution:</label>
            <input type="number" step="0.01" id="philhealth" name="philhealth" required>

            <label for="pagibig">Pag-IBIG Contribution:</label>
            <input type="number" step="0.01" id="pagibig" name="pagibig" required>

            <label for="tax">Tax Withholding:</label>
            <input type="number" step="0.01" id="tax" name="tax" required>

            <button type="submit">Calculate and Save Payroll</button>
        </form>

        <?php
        // information result 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "<div class='results'>";
            echo "<h2>Payroll Information for {$name} ({$position})</h2>";
            echo "<p><strong>Basic Salary:</strong> ₱" . number_format($basicSalary, 2) . "</p>";
            echo "<p><strong>Overtime Hours:</strong> {$overtimeHours}</p>";
            echo "<p><strong>Gross Pay:</strong> ₱" . number_format($grossPay, 2) . "</p>";
            echo "<p><strong>Total Deductions:</strong> ₱" . number_format($totalDeductions, 2) . "</p>";
            echo "<p><strong>Net Pay:</strong> ₱" . number_format($netPay, 2) . "</p>";
            echo "<p><strong>SSS Contribution:</strong> ₱" . number_format($sss, 2) . "</p>";
            echo "<p><strong>PhilHealth Contribution:</strong> ₱" . number_format($philhealth, 2) . "</p>";
            echo "<p><strong>Pag-IBIG Contribution:</strong> ₱" . number_format($pagibig, 2) . "</p>";
            echo "<p><strong>Tax Withholding:</strong> ₱" . number_format($tax, 2) . "</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>