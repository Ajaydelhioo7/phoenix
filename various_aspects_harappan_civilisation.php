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
    <title>What is StoneAge?</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/quiz_style.css">  -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        div#question-container {
    background: white;
    color: black;
    padding: 25px;
    border-radius: 15px;
}

        </style>
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
                            <option value="">Various Aspects of  Harappan Civilisation Questions</option>
                            <?php
                            $sql = "SELECT id, tag_name FROM tags WHERE parent_tag_name='various_aspects_of_harappan_civilization' OR tag_name='various_aspects_of_harappan_civilization'";
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
                    <h2>Various Aspects of Harappan Civilization</h2>
                    <a href="https://99notes.in/upsc-notes/general-studies-1/history/ancient-india/various-aspects-of-harappan-civilisation/">Original Content Link</a>
                    <h3>Town Planning</h3>
                    <p>Harappan civilisation features very impressive and very well-planned structures of the towns.

Settlement pattern– The whole town was divided into two parts – Citadel and a lower town.
Citadel was built higher than the lower town and could have housed the important people in the city – wealthy traders, rulers and priests. In comparison, the lower town housed ordinary people.
Both parts of the town were built on a raised platform. The whole city was fortified with burnt brick walls.
(Source 12th NCERT: Themes in World History)</p>
<h3>Society</h3>
<p>Various discoveries from the sites throw light on the social structure of the Harappan society –

No evidence of imperialism: The power gap between the oligarchs and the commoners cannot be too huge as we cannot find any evidence of dynastic politics or larger-than-life kings. Unlike the other ancient civilisations of the world, the Harappan civilisation showed remarkable equality.
Two levels in towns – The discovery of the citadel and lower town suggest that there were two classes of people in Harappan society – the oligarchy (group of rulers, wealthy merchants or priests) and the working class. Important buildings like citadels and granaries existed in the upper part of the town.
Joint Family: Multiple rooms suggest a Joint family being common.
Different construction techniques for ‘elite’ Buildings – Harappans had three tiers of habitation — ‘common settlements’ with mud brick walls, ‘elite settlements’ with burnt brick walls alongside mud brick walls, and possible ‘middle-rung settlements.
High level of standardisation – The presence of seals, standardisation of artefacts, and use of uniform weights hints toward the existence of a central authority regulating various economic activities.
The difference in Burial pattern – Some burials had hollowed-out spaces within the burial chamber, lined with bricks and had luxury items buried along with them, while many burials were simple.
Equality between men and women – Jewellery was found buried with the dead in the burials of both men and women, which indicated equality between men and women.</p>
<h3>Religion</h3>
<p>A predominantly secular society: Although we have found some religious symbols, such as the Pashupati seal and Mother Goddess, these don’t point to a predominantly religious society. This is because we have not found elaborate religious structures such as temples as those found in Egypt or Mesopotamia.  
No temples: Not many buildings in the Indus valley can be attributed to temple worship or dedicated to ritualism. However, structures like ‘the Great bath’ of Mohenjo-Daro could have been used for religious purposes. Despite this, few theories on deity worship have been developed.
The Proto Shiva theory: John Marshall put forward the first study of the religion of the Harappan civilisation.  
He tried to point out similarities between the Harappan religion and later-day Hinduism through the proto-Shiva seal.
In the ‘Pashupati Seal’, there is a man with two large horns. The animals surrounding him are similar to the Pashupati form of Shiva. John Marshall considered it as an early form of Shiva called mahayogi.
Some cylindrical stones similar to Shiva Linga were also found in Mohenjo-Daro and Harappa.
Mother goddess:
Among several female figurines discovered at Mohenjo-Daro and Harappa, Marshall pointed out the One with a fan-shaped headdress, wearing a bead necklace and short skirt to be a mother goddess. She represents the mother or nature goddess.
There is a terracotta figure from Harappa; a plant is shown out of the womb representing the fertility power of the goddess.
This suggests that the mother-goddess cult was prevalent in a few areas.
Phallus worship: There is evidence of phallus worship in the Indus valley civilisation as evident by the discovery of Male Yoni in several places like Harappa.
Fire Altars: The discovery of fire altars in a few places suggests the existence of a sacrificial ritual in the Harappan cultures.
The sacredness of Pipal trees: One seal depicts seven figures paying obeisance to the pipal tree. A horned figure stands on the tree. Some scholars argue that this scene is reminiscent of later-day Saptmatrikas (a group of seven mother-goddesses). Some even identify the figures as sapt-rishis.  </p>
<h3>Seals</h3>
<p>A seal works as a mark or a stamp. Harappans used to press a seal against wet clay to create a unique clay tablet, which could be used as a signature. This is how a seal works.
Usage– They were mainly used as a unit of trade and commerce, as an amulet (to ward off evil) and also as an educational tool (presence of a pie sign).
Shape and size: a standard Harappan seal was 2×2 square inches.
Materials: generally made from soft river stone and steatite.
Engravings: Each seal has a pictographic script along with animal impressions which are yet to be deciphered, written from right to left. Scholars believe that it might contain the name of the sender.
For example– the Pashupati Mahadev seal is made of steatite (Mahayogi Seal or the Proto-Siva Seal) found in Mohenjo-Daro. It depicts three-faced gods with buffalo horns sitting cross-legged on a throne surrounded by an elephant, a tiger in his right and a rhinoceros, buffalo in his left and two deer at his feet.</p>
<h3>Economy</h3>
<p>The Harappan landscape consisting of alluvial plains, mountains, plateau, and sea coasts, was rich enough to generate a surplus for trade. Occupations varied from farming, weaving, pottery, metal works, toy making, jewellery, stone cutting & trading.</p>
<h3>Agriculture</h3>
<p>They grew two crops yearly, but Rabi or winter crops seem to be the dominant practice. They grew wheat, barley, pea, chickpea, sesame, mustard and lentil in winters.
Kharif crops grown were rice and millet. They were probably one of the first to grow paddy in the world.
The Harappan farmers were the first people to spin and weave cotton. At Mohenjo-Daro, archaeologists discovered pieces of cotton textiles dating from between 3250 and 2750 BCE in 1929. In the nearby Mehrgarh site, cottonseeds have been found dating to 5000 BCE.
The technology used – We have found a terracotta plough model from Banawali and Bahawalpur and ploughed field at Kalibangan. In addition, copper sickles have been found in various places.
Irrigation – We find sheet-floodingin Sindh, canal irrigation for Ghaggar-Hakra, and usage of reservoirs in Dholavira.</p>
                  
                   

                    
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
                    url: 'fetch_variousaspects_harappancivilisation.php',
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