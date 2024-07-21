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
                            <option value="">All History Questions</option>
                            <?php
                            $sql = "SELECT id, tagName FROM tags WHERE parentTagName='What is History' OR tagName='What is History'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['tagName']}</option>";
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
                    <h2>What is History?</h2>
                    <a href="https://99notes.in/upsc-notes/general-studies-1/history/ancient-india/what-is-history/">Original Content Link</a>
                    <p>The word history is derived from the ancient Greek word ‘Historia’, which translates into ‘an inquiry. Thus the knowledge acquired by the investigation of the events of the past is history. In simple terms, it is the enquiry of the ‘human past’.</p>
                    <h2>Classification of the timeline in historical studies</h2>
                    <p>Historians have classified the study of history into the following divisions based on the tools used in different ages, knowledge of writing and modes of communication: -</p>
                    <ol>
                        <li>Pre-history – It consists of the events that occurred before the invention of writing. It is further classified as: -
                            <ul>
                                <li>Palaeolithic age or the Old Stone Age: The Greek word ‘lith’ refers to stone. It was the time when people first started using stone tools. It extends from 2,500,000 Million years ago (MYA) to 11,700 years ago. In this age, the tools used were unpolished and rough stones. This This age features the evolution of proto-humans to humans.</li>
                                <li>Mesolithic Period, or the Middle Stone Age – extends from 11,700 years ago to 6000 BCE. The time frame is different for different regions in the world. There is a prevalence of microliths (miniature stone tools) in this age, and by its end, people had started domesticating animals and cultivating plants.</li>
                                <li>Neolithic Period or the New Stone Age: The beginning of cultivation and the end of the hunting and gathering phase is the distinguishing feature of this age. It generally extends from 6000 BCE to 1000 BCE in most regions of the world. People used microlithic blades, polished stones, and weapons made of bones. People started living in rectangular or circular houses.</li>
                                <li>Chalcolithic Period or the Stone-Copper Age: The prefix ‘Chalco’ comes from the Greek word khalkos, meaning ‘copper’. At around 3000 BCE, people started using copper along with stone tools. This was the first time when metal was used. This led to an improvement in cultivation techniques, and people began growing cereals, pulses and cotton, apart from increased domestication of animals.</li>
                            </ul>
                        </li>
                        <li>Proto-history – refers to the civilisation phase of history before the invention of writing. Such civilisations find mention in the writings of other contemporary literate cultures. Even those cultures that had some mode of written communication but did not develop into fully functional languages are also classified as Proto-historical periods. For example – the Indus valley civilisation (IVC) valley script remains deciphered, but it is mentioned in the writings of the Mesopotamian civilisation. Therefore, it is classified as a proto-historical civilisation.</li>
                        <li>History - It consists of events that occurred after the invention of writing. Therefore, it enables us to reconstruct the actual events of the past on the basis of written records and archaeological sources. For example - the Edicts of the Ashokan period are an essential source for reconstructing the society, religion, polity and economy of the past.</li>
                    </ol>
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
        console.log("Loading question at index:", index); // Debug log
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
            url: 'fetch_history.php',
            type: 'GET',
            data: { tag_id: tag_id },
            success: function(response) {
                questions = JSON.parse(response);
                currentQuestionIndex = 0;
                loadQuestion(currentQuestionIndex);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching questions:', textStatus, errorThrown);
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error submitting answer:', textStatus, errorThrown);
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
