<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login_student.php");
    exit;
}

include './database/db.php'; // Ensure this path is correct.

$student = [];

// Fetch student details
$stmt = $conn->prepare("SELECT * FROM Students WHERE id = ?");
$stmt->bind_param("i", $_SESSION['student_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    echo "No student found with this ID.";
    exit;
}
$stmt->close();

$rollno = $student['rollno'];
$batch = $student['batch'];

// Fetch all tests for mains to display in chart
$stmt = $conn->prepare("SELECT * FROM mains_test_score WHERE rollno = ? ORDER BY id ASC");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$mains_tests = [];
while ($row = $result->fetch_assoc()) {
    $mains_tests[] = $row;
}
$stmt->close();

// Fetch all tests for pre to display in chart
$stmt = $conn->prepare("SELECT * FROM Test_Scores WHERE rollno = ? ORDER BY id ASC");
$stmt->bind_param("s", $rollno);
$stmt->execute();
$result = $stmt->get_result();
$pre_tests = [];
while ($row = $result->fetch_assoc()) {
    $pre_tests[] = $row;
}
$stmt->close();

// Convert PHP arrays to JSON for use in JavaScript
$mains_tests_json = json_encode(array_column($mains_tests, 'testname'));
$mains_marks_obtained_json = json_encode(array_column($mains_tests, 'marks_obtained'));
$pre_tests_json = json_encode(array_column($pre_tests, 'testname'));
$pre_marks_obtained_json = json_encode(array_column($pre_tests, 'marks_obtained'));
?>
<?php
// Assuming $mains_tests and $pre_tests contain all test records, and are sorted by date or id.
$current_mains_score = end($mains_tests)['marks_obtained'];
$previous_mains_score = prev($mains_tests)['marks_obtained'] ?? 0; // Safe fallback if only one test exists

// Calculate percentage increase or decrease
if ($previous_mains_score != 0) {
    $progress_percentage = (($current_mains_score - $previous_mains_score) / $previous_mains_score) * 100;
} else {
    $progress_percentage = 100; // If no previous score, assume 100% improvement
}

$progress_status = 'bg-success'; // Default green for improvement
$progress_message = 'Great job! Your scores are improving.';

if ($progress_percentage < 0) {
    $progress_status = 'bg-danger'; // Red for decline
    $progress_message = 'Looks like your scores have dropped. Let\'s work harder!';
} elseif ($progress_percentage == 0) {
    $progress_status = 'bg-warning'; // Yellow for no change
    $progress_message = 'Your scores are consistent. Try to push for higher!';
}

// Ensure the progress percentage is non-negative for the progress bar
$progress_percentage = abs($progress_percentage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include './includes/header.php'; ?>
   
    <div class="container mb-5">
        <!-- Mains Test Scores Chart -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header bg-info text-dark text-center"><h5>Mains Test Scores</h5></div>
                    <div class="card-body">
                        <canvas id="mainsTestScoresChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pre Test Scores Chart -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header bg-info text-dark text-center"><h5>Pre Test Scores</h5></div>
                    <div class="card-body">
                        <canvas id="preTestScoresChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
    <h4>Progress Overview</h4>
    <div class="progress">
        <div class="progress-bar <?php echo $progress_status; ?>" role="progressbar" style="width: <?php echo $progress_percentage; ?>%" aria-valuenow="<?php echo $progress_percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <p class="mt-2"><?php echo $progress_message; ?></p>
</div>
    <?php include './includes/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var mainsCtx = document.getElementById('mainsTestScoresChart').getContext('2d');
            var preCtx = document.getElementById('preTestScoresChart').getContext('2d');

            var mainsTestScoresChart = new Chart(mainsCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo $mains_tests_json; ?>,
                    datasets: [{
                        label: 'Marks Obtained',
                        data: <?php echo $mains_marks_obtained_json; ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Progress',
                        data: <?php echo $mains_marks_obtained_json; ?>,
                        type: 'line',
                        fill: false,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        tension: 0.4,
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stacked: false
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            var preTestScoresChart = new Chart(preCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo $pre_tests_json; ?>,
                    datasets: [{
                        label: 'Marks Obtained',
                        data: <?php echo $pre_marks_obtained_json; ?>,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Progress',
                        data: <?php echo $pre_marks_obtained_json; ?>,
                        type: 'line',
                        fill: false,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        tension: 0.4,
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stacked: false
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
</body>
</html>
