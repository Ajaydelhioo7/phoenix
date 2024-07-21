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

// Calculate rank for the latest mains test within the batch
$mains_last_test_rank = 0;
if (!empty($mains_tests)) {
    $latest_mains_test = end($mains_tests); // Gets the most recent test taken by the student
    $latest_mains_test_score = $latest_mains_test['marks_obtained']; // The score of the student in the latest test

    $stmt = $conn->prepare("SELECT COUNT(*) AS rank FROM mains_test_score WHERE batch = ? AND testname = ? AND marks_obtained > ?");
    $stmt->bind_param("ssi", $batch, $latest_mains_test['testname'], $latest_mains_test_score);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $mains_last_test_rank = $row['rank'] + 1; // Including the student themselves in rank count
    }
    $stmt->close();
}

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

// Calculate rank for the latest pre test within the batch
$pre_last_test_rank = 0;
if (!empty($pre_tests)) {
    $latest_pre_test = end($pre_tests); // Gets the most recent test taken by the student
    $latest_pre_test_score = $latest_pre_test['marks_obtained']; // The score of the student in the latest test

    $stmt = $conn->prepare("SELECT COUNT(*) AS rank FROM Test_Scores WHERE batch = ? AND testname = ? AND marks_obtained > ?");
    $stmt->bind_param("ssi", $batch, $latest_pre_test['testname'], $latest_pre_test_score);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $pre_last_test_rank = $row['rank'] + 1; // Including the student themselves in rank count
    }
    $stmt->close();
}

// Convert PHP arrays to JSON for use in JavaScript
$mains_tests_json = json_encode(array_column($mains_tests, 'testname'));
$mains_marks_obtained_json = json_encode(array_column($mains_tests, 'marks_obtained'));
$mains_tests_data_json = json_encode($mains_tests);

$pre_tests_json = json_encode(array_column($pre_tests, 'testname'));
$pre_marks_obtained_json = json_encode(array_column($pre_tests, 'marks_obtained'));
$pre_tests_data_json = json_encode($pre_tests);
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
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-trendline"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/regression@2.0.0/dist/regression.min.js"></script>

</head>
<body>
    <?php include './includes/header.php'; ?>
    <h5>Welcome, <?php echo htmlspecialchars($student['name']); ?></h5>
    <div class="container mb-5">
        <!-- Display ranks for last tests -->
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header bg-warning text-dark text-center"><h5>Last Mains Test Rank</h5></div>
                    <div class="card-body">
                        <h3 class="card-title text-center text-primary"><?php echo $mains_last_test_rank; ?></h3>
                        <p class="card-text text-dark text-center">Rank in the last mains test</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header bg-success text-dark text-center"><h5>Last Pre Test Rank</h5></div>
                    <div class="card-body">
                        <h3 class="card-title text-center text-primary"><?php echo $pre_last_test_rank; ?></h3>
                        <p class="card-text text-dark text-center">Rank in the last pre test</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart for mains test scores -->
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
        <!-- Chart for pre test scores -->
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

    <?php include './includes/footer.php'; ?>

    <!-- Modal -->
    <div class="modal fade" id="testDetailsModal" tabindex="-1" aria-labelledby="testDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testDetailsModalLabel">Test Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="testDetailsContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var mainsTestsData = <?php echo $mains_tests_data_json; ?>;
            var preTestsData = <?php echo $pre_tests_data_json; ?>;

            var mainsCtx = document.getElementById('mainsTestScoresChart').getContext('2d');
            var preCtx = document.getElementById('preTestScoresChart').getContext('2d');

            var showTestDetails = function(testData) {
                var content = `<strong>Test Name:</strong> ${testData.testname}<br>
                               <strong>Marks Obtained:</strong> ${testData.marks_obtained}<br>
                               <strong>Max Marks:</strong> ${testData.max_marks}<br>
                               <strong>Percentage:</strong> ${testData.percentage}%`;
                document.getElementById('testDetailsContent').innerHTML = content;
                var myModal = new bootstrap.Modal(document.getElementById('testDetailsModal'), {});
                myModal.show();
            };

            var mainsTestScoresChart = new Chart(mainsCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo $mains_tests_json; ?>,
                    datasets: [
                        {
                            label: 'Marks Obtained',
                            data: <?php echo $mains_marks_obtained_json; ?>,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            trendlineLinear: {
                                style: "rgba(255,105,180, .8)",
                                lineStyle: "solid",
                                width: 2
                            }
                        }
                    ]
                },
                options: {
                    plugins: {
                        datalabels: {
                            align: 'end',
                            anchor: 'end',
                            formatter: function(value, context) {
                                return context.chart.data.labels[context.dataIndex];
                            },
                            color: 'black',
                            font: {
                                weight: 'bold'
                            }
                        },
                        trendlineLinear: {
                            style: "rgba(255,105,180, .8)",
                            lineStyle: "solid",
                            width: 2
                        }
                    },
                    onClick: (evt, item) => {
                        if (item.length > 0) {
                            var index = item[0].index;
                            showTestDetails(mainsTestsData[index]);
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'black'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'black'
                            }
                        }
                    },
                    legend: {
                        labels: {
                            color: 'black'
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutBounce'
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });

            var preTestScoresChart = new Chart(preCtx, {
                type: 'bar',
                data: {
                    labels: <?php echo $pre_tests_json; ?>,
                    datasets: [
                        {
                            label: 'Marks Obtained',
                            data: <?php echo $pre_marks_obtained_json; ?>,
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1,
                            trendlineLinear: {
                                style: "rgba(255,105,180, .8)",
                                lineStyle: "solid",
                                width: 2
                            }
                        }
                    ]
                },
                options: {
                    plugins: {
                        datalabels: {
                            align: 'end',
                            anchor: 'end',
                            formatter: function(value, context) {
                                return context.chart.data.labels[context.dataIndex];
                            },
                            color: 'black',
                            font: {
                                weight: 'bold'
                            }
                        },
                        trendlineLinear: {
                            style: "rgba(255,105,180, .8)",
                            lineStyle: "solid",
                            width: 2
                        }
                    },
                    onClick: (evt, item) => {
                        if (item.length > 0) {
                            var index = item[0].index;
                            showTestDetails(preTestsData[index]);
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'black'
                            }
                        },
                        x: {
                            ticks: {
                                color: 'black'
                            }
                        }
                    },
                    legend: {
                        labels: {
                            color: 'black'
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeInOutBounce'
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    </script>
</body>
</html>
