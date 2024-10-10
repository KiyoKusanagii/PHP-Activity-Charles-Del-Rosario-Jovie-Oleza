<?php
session_start();

// Initialize an array to store submissions
if (!isset($_SESSION['submissions'])) {
    $_SESSION['submissions'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Store the submission in the session
    $submission = [
        'First Name' => $firstName,
        'Last Name' => $lastName,
        'Age' => $age,
        'Contact' => $contact,
        'Address' => $address
    ];

    array_push($_SESSION['submissions'], $submission);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form - Girly Theme</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Contact Form</h2>
            <form action="index.php" method="POST" onsubmit="return validateForm()">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required><br>

                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required><br>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required><br>

                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" required><br>

                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea><br>

                <input type="submit" value="Submit">
            </form>
        </div>

        <div class="list-container">
            <h2>Submissions</h2>
            <?php if (!empty($_SESSION['submissions'])): ?>
                <?php foreach ($_SESSION['submissions'] as $index => $submission): ?>
                    <div class='submission-item'>
                        <h3>Submission <?php echo ($index + 1); ?></h3>
                        First Name: <?php echo htmlspecialchars($submission['First Name']); ?><br>
                        Last Name: <?php echo htmlspecialchars($submission['Last Name']); ?><br>
                        Age: <?php echo htmlspecialchars($submission['Age']); ?><br>
                        Contact: <?php echo htmlspecialchars($submission['Contact']); ?><br>
                        Address: <?php echo htmlspecialchars($submission['Address']); ?><br>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No submissions yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function validateForm() {
            let age = document.getElementById("age").value;
            if (age <= 0) {
                alert("Age must be a positive number.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
