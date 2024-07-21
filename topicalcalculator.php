<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require 'db_connect.php';

// Get the user's globalRating
$user_id = $_SESSION['user_id'];
$sql = "SELECT globalRating FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($globalRating);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What is History?</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/quiz_style.css"> <!-- Link the new CSS file -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
   
    <?php include('./includes/header.php')?>
    
    <div class="container mt-5">
        <h2>Topical Calculator</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">What is History</h5>
                        <p class="card-text">History is the study of past events, particularly in human affairs. It encompasses a variety of topics and interpretations.</p>
                        <a href="./history.php" class="btn btn-primary">Attempt Quiz</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">The Stone Age</h5>
                        <p class="card-text">The Stone Age is a prehistoric period during which stone was widely used to make tools and weapons. It marks the beginning of human technology.</p>
                        <a href="./stoneage.php" class="btn btn-primary">Attempt Quiz</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Chalcolithic</h5>
                        <p class="card-text">The Chalcolithic, or Copper Age, is a transitional period between the Neolithic and the Bronze Age, characterized by the use of copper tools.</p>
                        <a href="chalcolothic.php" class="btn btn-primary">Attempt Quiz</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Harappan Civilization</h5>
                        <p class="card-text">The Harappan Civilization, also known as the Indus Valley Civilization, was a Bronze Age civilization in the northwestern regions of South Asia.</p>
                        <a href="harappan_civilisation.php" class="btn btn-primary">Attempt Quiz</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Various Aspects of Harappan Civilization</h5>
                        <p class="card-text">This civilization is known for its advanced urban planning, architecture, and social organization, which are key aspects of its study.</p>
                        <a href="various_aspects_harappan_civilisation.php" class="btn btn-primary">Attempt Quiz</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let questions = [];
            let currentQuestionIndex = 0;
            let attemptedQuestions = 0;
            let isSubscribed = false;

            function loadQuestion(index) {
                if (index < questions.length) {
                    const question = questions[index];
                    $('#question-text').hide().text(question.question).fadeIn(500).addClass('fade-in-right');
                    $('#label-option1').text(question.option1);
                    $('#label-option2').text(question.option2);
                    $('#label-option3').text(question.option3);
                    $('#label-option4').text(question.option4);
                    $('#question_id').val(question.id);
                    $('input[name="answer"]').prop('checked', false);
                    $('.answer-result').empty(); // Clear the previous answer result
                } else {
                    $('#question-container').html('<p>No more questions available.</p>');
                }
            }

            function updateGlobalRating() {
                $.ajax({
                    url: 'fetch_global_rating.php',
                    type: 'GET',
                    success: function(response) {
                        $('#globalRating').text(response);
                    }
                });
            }

            $('#tagFilter').change(function() {
                var tag_id = $(this).val();
                $.ajax({
                    url: 'fetch_questions_history.php',
                    type: 'GET',
                    data: { tag_id: tag_id },
                    success: function(response) {
                        questions = JSON.parse(response);
                        currentQuestionIndex = 0;
                        loadQuestion(currentQuestionIndex);
                    }
                });
            });

            $('#question-form').submit(function(e) {
                e.preventDefault();

                if (attemptedQuestions >= 5 && !isSubscribed) {
                    $('#subscriptionModal').modal('show');
                    return;
                }

                var form = $(this);
                $.ajax({
                    url: 'submit_answer.php',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        form.find('.answer-result').html(response); // Show the answer result
                        updateGlobalRating(); // Update globalRating after submitting an answer
                        currentQuestionIndex++;
                        attemptedQuestions++;
                        setTimeout(function() {
                            loadQuestion(currentQuestionIndex);
                        }, 1000); // Delay loading the next question to give time for the user to see the answer result
                    }
                });
            });

            $('#submitPromoCode').click(function() {
                const promoCode = $('#promoCode').val();
                if (promoCode === 'ajay') {
                    isSubscribed = true;
                    $('#subscriptionModal').modal('hide');
                    attemptedQuestions = 0; // Reset the counter so the user can attempt more questions
                    $('#promoCodeError').hide(); // Hide any previous error messages
                } else {
                    $('#promoCodeError').show();
                }
            });

            // Load questions on page load
            $('#tagFilter').trigger('change');

            // Update globalRating every 5 seconds
            setInterval(updateGlobalRating, 5000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php include('./includes/footer.php')?>
</body>
</html>