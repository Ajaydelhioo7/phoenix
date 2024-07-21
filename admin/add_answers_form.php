<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Answers</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- Adjust path as necessary -->
</head>
<body>
<div class="container mt-5">
    <h2>Add Answers for Each Set</h2>
    <form action="admin_submit_answers.php" method="post">
        <div class="form-group">
            <label for="setId">Set ID:</label>
            <input type="text" class="form-control" id="setId" name="setId" required>
        </div>
        <?php for ($i = 1; $i <= 100; $i++): ?>
        <div class="form-group">
            <label>Question <?php echo $i; ?>:</label>
            <div>
                <label class="form-check-label">A</label>
                <input type="radio" name="answers[<?php echo $i; ?>]" value="A" required>
                <label class="form-check-label">B</label>
                <input type="radio" name="answers[<?php echo $i; ?>]" value="B">
                <label class="form-check-label">C</label>
                <input type="radio" name="answers[<?php echo $i; ?>]" value="C">
                <label class="form-check-label">D</label>
                <input type="radio" name="answers[<?php echo $i; ?>]" value="D">
            </div>
        </div>
        <?php endfor; ?>
        <button type="submit" class="btn btn-primary">Submit Answers</button>
    </form>
</div>

<script src="../jquery/jquery-3.5.1.slim.min.js"></script> <!-- Adjust path as necessary -->
<script src="../bootstrap/js/bootstrap.min.js"></script> <!-- Adjust path as necessary -->
</body>
</html>
