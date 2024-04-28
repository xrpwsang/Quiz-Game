<?php
include 'dbconnection.php'; 
include 'dashboard.php';

$query = "SELECT * FROM category_name";
$result = mysqli_query($conn, $query);

$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[$row['category_id']] = $row['category'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $option1 = mysqli_real_escape_string($conn, $_POST['option1']);
    $option2 = mysqli_real_escape_string($conn, $_POST['option2']);
    $option3 = mysqli_real_escape_string($conn, $_POST['option3']);
    $option4 = mysqli_real_escape_string($conn, $_POST['option4']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category']);

    // Insert the question into the quiz_question table
    $insert = "INSERT INTO quiz_question (question, option1, option2, option3, option4, category_id) 
               VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$category_id')";

    if (mysqli_query($conn, $insert)) {
        echo "Question submitted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="admin.css"> -->
    <title>Question Form</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        /* Add your additional CSS styles here */
        .form-container select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
    </style>
   
</head>
<body>

<div class="form-container">
    <h2>Enter the Multiple Choice Question</h2>
    <form action="#" method="post">
    <label>
            <input type="text" name="question" placeholder="Enter your Question here"> 
        </label>
        
        <label>
            <input type="text" name="option1" placeholder="Option1"> 
        </label>
        <label>
            <input type="text" name="option2" placeholder="Option2"> 
        </label>
        <label>
            <input type="text" name="option3" placeholder="Option3"> 
        </label>
        <label>
            <input type="text" name="option4" placeholder="Option4"> 
        </label>
        <label>
            <select name="category">
                <?php foreach ($categories as $category_id => $category): ?>
                    <option value="<?php echo $category_id; ?>"><?php echo $category; ?></option>
                <?php endforeach; ?>
            </select>
        </label>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
