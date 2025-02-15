<?php
include('dbconnection.php');
include('session.php');

// Set default date to today's date if no date is selected
$date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');

// Get expenses for the selected date
$stmt = $pdo->prepare("SELECT * FROM expenses WHERE date = ?");
$stmt->execute([$date]);
$expenses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Expenses</title>
    <link rel="stylesheet" href="viewer.css">
</head>
<body>
    <div class="container">
        <h2>View Expenses for <?php echo $date; ?></h2>

        <!-- Date selection form -->
        <form method="POST" action="view_expenses.php">
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required>
            <button type="submit">View</button>
        </form>

        <!-- Table to display expenses -->
        <table>
            <thead>
                <tr>
                    <th>Expense</th>
                    <th>Cost</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($expenses): ?>
                    <?php foreach ($expenses as $expense): ?>
                        <tr>
                            <td><?php echo $expense['expense_name']; ?></td>
                            <td><?php echo $expense['cost']; ?></td>
                            <td><?php echo $expense['description']; ?></td>
                            <td><?php echo $expense['date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No expenses found for this date.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
