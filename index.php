<?php
include('dbconnection.php');
include('session.php');

// Pagination setup
$limit = 10; // Records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total records count
$totalStmt = $pdo->query("SELECT COUNT(DISTINCT date) AS total FROM expenses");
$totalDates = $totalStmt->fetch()['total'];
$totalPages = ceil($totalDates / $limit);

// Fetch distinct dates with pagination
$stmt = $pdo->prepare("SELECT DISTINCT date FROM expenses ORDER BY date DESC LIMIT $limit OFFSET $offset");
$stmt->execute();
$dates = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Dates</title>
    <link rel="stylesheet" href="dates.css">
</head>
<body>
    <div class="container">
        <h2>Available Expense Dates</h2>
            <a class="back-to-all" href="new_record.php">Add new expense</a>
        <!-- Date Cards -->
        <div class="date-list">
            <?php if ($dates): ?>
                <?php foreach ($dates as $date): ?>
                    <a href="view_expenses.php?date=<?php echo $date['date']; ?>" class="date-card">
                        <span><?php echo $date['date']; ?></span>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No expense records found.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>" class="prev">Previous</a>
            <?php endif; ?>

            <span>Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

            <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>" class="next">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
