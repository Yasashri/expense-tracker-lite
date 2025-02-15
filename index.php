<?php
include('dbconnection.php');
include('session.php');

// Initialize success message
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $expense_name = $_POST['expense_name'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];

    // Insert the expense record into the database
    $stmt = $pdo->prepare("INSERT INTO expenses (date, expense_name, cost, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$date, $expense_name, $cost, $description]);

    // Set success message to show toast
    $successMessage = "Record added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>

<body>
    <div class="container">
        <h2>බෝල බන්ඩි Expenses</h2>
        <a href="view_expenses.php"><button class="all-expenses">View all my expenses</button></a>
        <form method="POST">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" value="<?= date('Y-m-d'); ?>" required>

            <label for="expense_name">Expense Name/Item:</label>
            <input type="text" name="expense_name" id="expense_name" required>

            <label for="cost">Cost:</label>
            <input type="number" name="cost" id="cost" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>

    <?php if ($successMessage): ?>
        <script>
            toastr.success("<?= $successMessage; ?>"); // Show the success toast
            document.querySelector("form").reset(); // Reset the form for next entry
        </script>
    <?php endif; ?>

</body>

</html>