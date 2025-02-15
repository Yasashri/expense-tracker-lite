<?php
include('dbconnection.php');
include('session.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $expense_name = $_POST['expense_name'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];

    // Insert the expense record into the database
    $stmt = $pdo->prepare("INSERT INTO expenses (date, expense_name, cost, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$date, $expense_name, $cost, $description]);

    echo "Record added successfully!";
}
?>
