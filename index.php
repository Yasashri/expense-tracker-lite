<?php
// You can include session and database connection files here if needed
include('dbconnection.php');
include('session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Expenses</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Record Your Daily Expenses</h2>
        <h4><a href="view_expenses.php">View all my expenses</a></h4>
        <form method="POST" action="insert_expense.php">
            <label for="date">Date</label>
            <!-- Set the default value as the current date using PHP -->
            <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required><br><br>

            <label for="expense_name">Expense Name/Item</label>
            <input type="text" id="expense_name" name="expense_name" required><br><br>

            <label for="cost">Cost</label>
            <input type="number" id="cost" name="cost" step="0.01" required><br><br>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea><br><br>

            <button type="submit">Add Expense</button>
        </form>
    </div>
</body>
</html>
