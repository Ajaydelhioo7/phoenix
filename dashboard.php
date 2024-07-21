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

// Determine heading and paragraph based on globalRating
if ($globalRating >= 85) {
    $heading = "Your chance of clearing Prelims this Year is 9 of 10 times";
    $paragraph = "You have shown an Excellent Progress. Your chance of selection is very high.
 
With this level of progress you just need to keep revising regularly and attempt full length test occasionally, and then you are good to go. Attempt this year's Prelims very well.
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30.
";
    $successRate = 90;
} elseif ($globalRating >= 75) {
    $heading = "Your chance of clearing Prelims this Year is 8 out of 10 times";
    $paragraph = "You have shown Amazing Progress. You have a good preparation for this year's Prelims. We advise you to attempt this year’s Prelims.
 
With this level of progress you just need to keep revising regularly and attempt about 5 more full length tests, and then you are good to go. You can focus on key improvement areas as given below. 
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 80;
} elseif ($globalRating >= 70) {
    $heading = "Your chance is 7 out of 10 times";
    $paragraph = "You have good Progress. You have a good preparation for this year's Prelims. Although you can improve even better, we advise you to attempt this year’s Prelims. 
 
This is no time to remain anxious, with this level of progress you just need to keep revising regularly and attempt about 5-10 more full length tests, and then you are good to go. You can focus on key improvement areas as given below. 
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30.";
    $successRate = 70;
} elseif ($globalRating >= 65) {
    $heading = "Your chance is 6 out of 10 times";
    $paragraph = "You have good Progress. You have a good preparation for this year's Prelims. Although you can improve even better, we advise you to attempt this year’s Prelims. 
 
This is no time to remain anxious, with this level of progress you just need to keep revising regularly and attempt about 10 more full length tests, and then you are good to go. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly.
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. ";
    $successRate = 60;
} elseif ($globalRating >= 60) {
    $heading = "Your chance is 5 out of 10 times";
    $paragraph = "You have satisfactory Progress. You have a good preparation for this year's Prelims. Although you can improve even better, we advise you to attempt this year’s Prelims. 

This is no time to remain anxious, with this level of progress you just need to keep revising regularly. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. 
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 50;
} elseif ($globalRating >= 55) {
    $heading = "Your chance is 4 out of 10 times";
    $paragraph = "You have satisfactory Progress. You have a good preparation for this year's Prelims. You should take the decision of attempting this year's Prelims cautiously. Do not take this attempt if you have very few remaining. If this is your first attempt, you might choose to try your luck

This is no time to remain anxious, with this level of progress you just need to keep revising regularly. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. 

Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 40;
} elseif ($globalRating >= 50) {
    $heading = "Your chance is 3 out of 10 times";
    $paragraph = "Your Progress is below satisfactory. You should take the decision of attempting this year's Prelims cautiously. Do not take this attempt if you have very few remaining. If this is your first attempt, you might choose to try your luck

This is no time to remain anxious, with this level of progress you just need to keep revising regularly. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. 

Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 30;
} elseif ($globalRating >= 45) {
    $heading = "Your chance is 2 out of 10 times";
    $paragraph = "Your Progress is below satisfactory. You should not attempt this year's Prelims. Do not take this attempt if you have very few remaining. If this is your first attempt, you might choose to try your luck

This is no time to remain anxious, with this level of progress you just need to keep revising regularly. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. 

Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 20;
} elseif ($globalRating >= 40) {
    $heading = "Your chance is 1 out of 10 times";
    $paragraph = "Your Progress is not good. You should not attempt this year's Prelims. Do not take this attempt if you have very few remaining. If this is your first attempt, you might choose to try your luck

This is no time to remain anxious. You might choose to revisit the core content. This is possible by both self-study as well as through coaching. If you need to know how to move forward from here click on “this article”.

You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. Only then you will be ready for the Prelims.
";
    $successRate = 10;
} else {
    $heading = "Your chance is 0 out of 10 times";
    $paragraph = "Your Progress is not good. You should not attempt this year's Prelims. Definitely do not try your luck if you have very few remaining. 

This is no time to remain anxious. You might choose to revisit the core content. This is possible by both self-study as well as through coaching. If you need to know how to move forward from here click on “this article”.

You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. Only then you will be ready for the Prelims.
";
    $successRate = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link the new CSS file -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
.background-text{
    position:absolute;
    top:0px;
    height: 500px;
    width: 70%;
    margin-top: 40px;
}
/* styles.css */

@keyframes slideInFromLeft {
    0% {
        transform: translateX(-100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideInFromRight {
    0% {
        transform: translateX(100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

.background {
    animation: slideInFromLeft 2s ease-out forwards;
}

.background-text {
    animation: slideInFromRight 2s ease-out forwards;
}
/* styles.css */

/* Hover Effects */
.card:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
}

/* Animation on scroll */
@keyframes slideInFromLeft {
    0% {
        transform: translateX(-100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideInFromRight {
    0% {
        transform: translateX(100%);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

.card {
    opacity: 0;
    transition: opacity 1s ease-out;
}

.card.visible-left {
    opacity: 1;
    animation: slideInFromLeft 1s ease-out forwards;
}

.card.visible-right {
    opacity: 1;
    animation: slideInFromRight 1s ease-out forwards;
}
@media only screen and (max-width: 600px) {
    .background-text {
   height:200px;
}
}
a.btn.btn-primary {
    background: white;
    color: black;
}
    </style>
</head>
<body>
    
    <?php include('./includes/header.php')?>
    <!-- <h5>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?> -->
    <div class="container-fluid">
        <div class="row">
            <img class="background" src="./assets/images/pheonix-background.webp" alt="">
            <img class="background-text" src="./assets/images/pheonix-text.webp" alt="">
        </div>
    </div>
    <!-- <div class="container ">
       </h5>
         <h3 class="text-center p-3">Beta Products</h3>
        <div class="row">
         
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">UPSC Prelims Result</h5>
                        <p class="card-text">This is a demo content for the Topical Calculator. It helps in calculating the topical performance based on your recent activities.</p>
                        <a href="./upscprelimsresult" class="btn btn-primary">Go to Calculator</a>
                    </div>
                </div>
            </div>
               <div class="col-md-6 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Topical Subscription</h5>
                        <p class="card-text">This is a demo content for the Topical Calculator. It helps in calculating the topical performance based on your recent activities.</p>
                        <a href="./topicalcalculator.php" class="btn btn-primary">Go to Calculator</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pre Result Calculator</h5>
                        <p class="card-text">This is a demo content for the Pre Result Calculator. It helps in predicting your pre-exam results based on various parameters.</p>
                        <a href="./pre_result_calculator" class="btn btn-primary">Go to Calculator</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Success Ratio Calculator</h5>
                        <p class="card-text">This is a demo content for the Success Ratio Calculator. It calculates your success ratio based on your performance metrics.</p>
                        <a href="./success_ratio_predictor/index.php" class="btn btn-primary">Go to Calculator</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Design Your Own Test</h5>
                        <p class="card-text">This is a demo content for designing your own test. You can create custom tests to assess your preparation level.</p>
                        <a href="#" class="btn btn-primary">Design Test</a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container">
        <h3 class="text-center p-3 animate__animated animate__fadeInDown">Beta Products</h3>
        <div class="row">
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card animate__animated animate__fadeInUp animated-hover" data-animate="left">
                    <div class="card-body">
                        <h5 class="card-title">UPSC Prelims Result</h5>
                        <p class="card-text">This is a demo content for the Topical Calculator. It helps in calculating the topical performance based on your recent activities.</p>
                        <a href="./upscprelimsresult" class="btn btn-primary">Go to Calculator</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card animate__animated animate__fadeInUp animated-hover" data-animate="right">
                    <div class="card-body">
                        <h5 class="card-title">Topical Subscription</h5>
                        <p class="card-text">This is a demo content for the Topical Calculator. It helps in calculating the topical performance based on your recent activities.</p>
                        <a href="./topicalcalculator.php" class="btn btn-primary">Go to Calculator</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card animate__animated animate__fadeInUp animated-hover" data-animate="left">
                    <div class="card-body">
                        <h5 class="card-title">Pre Result Calculator</h5>
                        <p class="card-text">This is a demo content for the Pre Result Calculator. It helps in predicting your pre-exam results based on various parameters.</p>
                        <a href="./pre_result_calculator" class="btn btn-primary">Go to Calculator</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card animate__animated animate__fadeInUp animated-hover" data-animate="right">
                    <div class="card-body">
                        <h5 class="card-title">Success Ratio Calculator</h5>
                        <p class="card-text">This is a demo content for the Success Ratio Calculator. It calculates your success ratio based on your performance metrics.</p>
                        <a href="./success_ratio_predictor/index.php" class="btn btn-primary">Go to Calculator</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 mb-4">
                <div class="card animate__animated animate__fadeInUp animated-hover" data-animate="left">
                    <div class="card-body">
                        <h5 class="card-title">Design Your Own Test</h5>
                        <p class="card-text">This is a demo content for designing your own test. You can create custom tests to assess your preparation level.</p>
                        <a href="#" class="btn btn-primary">Design Test</a>
                    </div>
                </div>
            </div>
            <div class="container">
            <h2 class="text-center p-3">Merely taking offline classes to video setup is not Edtech- No Tech in Indian Edtech</h2>
            <p>
At 99Notes, we are mad believers in the transformative power of technology. We fundamentally believe
that tech can democratize education, making it more analytical, practical, and accessible to all.
So, why then are we also running a coaching institute? The answer is simple: no car can be driven
without fuel, and nobody can work without money. Our institute provides the necessary resources to
fuel this revolution.
The truth is, there is currently no real tech in Indian EdTech. But we are here to change that.
At 99Notes, we harness the power of deep tech and artificial intelligence to increase your chances of
success and help you navigate through your weaker areas with precision. Our advanced algorithms and
machine learning models analyze your performance, providing personalized feedback and adaptive
learning paths that ensure you are always moving forward.
We are not just talking about the future; we are building it. Every day, we rigorously test our products,
ensuring they meet the highest standards of effectiveness and reliability. Our vision is to create a
platform where technology bridges the gap between traditional education and the demands of modern
competitive exams, particularly in the realm of government examinations.
Imagine a learning experience where AI-driven insights identify your strengths and weaknesses, virtual
reality simulations offer immersive learning environments, and predictive analytics forecast your
performance trends. This is not a distant dream; this is the future we are building at 99Notes.
We invite you to be a part of this revolution. Register yourself to become a beta user and contribute to a
better tomorrow. Together, we can transform education and create opportunities for millions. Join us in
making education smarter, more efficient, and truly impactful.<br>
Anmol Goel<br>
Founder, 99Notes</p>
            </div>
          
        </div>
    </div>
    <?php include('./includes/footer.php')?>
    <script>
        const ctx = document.getElementById('myPieChart').getContext('2d');
        const data = {
            labels: ['Success', 'Failure'],
            datasets: [{
                data: [<?php echo $successRate; ?>, <?php echo 100 - $successRate; ?>],
                backgroundColor: ['#4caf50', '#f44336']
            }]
        };
        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        };
        const myPieChart = new Chart(ctx, config);
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Scroll animation
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.dataset.animate === 'left') {
                            entry.target.classList.add('visible-left');
                        } else if (entry.target.dataset.animate === 'right') {
                            entry.target.classList.add('visible-right');
                        }
                    }
                });
            });

            document.querySelectorAll('.card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
    
</body>
</html>