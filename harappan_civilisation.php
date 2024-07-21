<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require 'db_connect.php';
require 'db.php';

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
    <title>What is StoneAge?</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/quiz_style.css">  -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

    <?php include('./includes/header.php')?>
    <div class="container mt-5">
        <div class="row">
        <div class="col-md-12 mb-5">
                <div class="dashboard-content p-5">
                    <div class="form-group">
                        <label for="tagFilter">Select Tag:</label>
                        <select class="form-control" id="tagFilter" name="tagFilter">
                            <option value="">All Harappan Civilisation Questions</option>
                            <?php
                            $sql = "SELECT id, tag_name FROM tags WHERE parent_tag_name='Harappan Civilisation' OR tag_name='Harappan Civilisation'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['tag_name']}</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div id="questions">
                        <!-- Questions will be loaded here via AJAX -->
                    </div>
                    <div id="question-container" class="mt-4">
                        <form id="question-form" class="question-form">
                            <div id="question-text" class="fade-in-right"></div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="1" id="option1" required>
                                <label class="form-check-label" for="option1" id="label-option1"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="2" id="option2" required>
                                <label class="form-check-label" for="option2" id="label-option2"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="3" id="option3" required>
                                <label class="form-check-label" for="option3" id="label-option3"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="4" id="option4" required>
                                <label class="form-check-label" for="option4" id="label-option4"></label>
                            </div>
                            <input type="hidden" name="question_id" id="question_id">
                            <button type="submit" class="btn btn-primary mt-3">Submit and Next</button>
                            <div class="answer-result mt-3"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="content-section">
                    <h2>Harappan Civilization</h2>
                    <a href="https://99notes.in/upsc-notes/general-studies-1/history/ancient-india/harappan-civilisation-3300bce-1300bce/">Original Content Link</a>
                   <p>Indus Valley Civilization, also known as Harappan civilization was the first urban culture in the Indian subcontinent. It was a bronze age culture that flourished in North-western Indian subcontinent. It was earlier known as the Indus valley civilization as most sites discovered were near the Indus valley river system. However, as the discovery of newer sites outside the Indus river system progressed it became clear that the extent of the civilization covered even the Ganga plains. Scholars now prefer to call it Harappa Civilization, after name of the first site discovered here.</p>
                   <h3>Chronology of Indus Valley Civilization</h3>
                   <p>Although various sites in the Indus valley dates back to the Neolithic era from before 5000BCE, the ‘bronze age’ Harappan civilization is dated between 3300 BCE to 1300 BCE. This whole period is divided into three phases: Early Harappan, Mature Harappan and Late Harappan, as given below </p>
                   <h3>The Extent of the Indus Valley Civilization</h3>
                   <p>The Indus valley Civilization saw many striking features that the civilizations of that time, namely, Mesopotamia, Egypt and China lacked. These include the focus on sanitation, city planning, secular society and the degree of equality. This aspect is discussed in detail in our next page. </p>
                   <h3>Chronology of Excavations/Discovery of sites </h3>
                   <p>Following is the gist of all the major excavations that have taken place till date in the Indus valley civilization. </p>
                   <p>Harappan Civilization was discovered by archaeologist Sir John Marshal and Daya Ram Sahni in 1921. Daya Ram Sahni excavated the site of Harappa in modern day Pakistan.</p>
                   <p>Sumerian Civilization in Mesopotamia, dating back to around 4500BCE, is considered the world’s oldest civilization. Indus Valley civilization (3300BCE- 1300BCE)</p>
                   

                    
                </div>
            </div>
          
        </div>
    </div>

    <!-- Subscription Modal -->
    <div class="modal fade" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subscriptionModalLabel">Subscription Required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You have attempted 5 questions. Please enter a promo code to continue.</p>
                    <div class="form-group">
                        <label for="promoCode">Promo Code:</label>
                        <input type="text" class="form-control" id="promoCode" placeholder="Enter promo code">
                    </div>
                    <div id="promoCodeError" class="text-danger" style="display: none;">Invalid promo code. Please try again.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submitPromoCode">Submit</button>
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
                    url: 'fetch_harrapancivilisation.php',
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