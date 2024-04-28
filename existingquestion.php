<?php
include 'dbconnection.php'; 
include 'dashboard.php';

// Fetch questions and options from the database
$query = "SELECT * FROM quiz_question";
$result = mysqli_query($conn, $query);

$query1 = "SELECT qq.*, cn.category 
          FROM quiz_question qq
          JOIN category_name cn ON qq.category_id = cn.category_id";
$result = mysqli_query($conn, $query1);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Table</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            margin-left:270px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Quiz Questions</h2>

<table>
    <thead>
        <tr>
            <th>Question</th>
            <th>Option 1</th>
            <th>Option 2</th>
            <th>Option 3</th>
            <th>Option 4</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['question']; ?></td>
                <td><?= $row['option1']; ?></td>
                <td><?= $row['option2']; ?></td>
                <td><?= $row['option3']; ?></td>
                <td><?= $row['option4']; ?></td>
                <td><?= $row['category']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
