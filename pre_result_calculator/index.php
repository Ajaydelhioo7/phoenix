<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questionnaire Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-Color:#f2f2f2;
            padding:30px;
            padding-bottom:80px;
        }
        .questions-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
        }
        .column {
            display: flex;
            flex-direction: column;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .question {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }
        .question-label {
            margin-right: 10px;
            font-weight: bold;
        }
        .form-check-label {
            margin-right: 10px;
        }
        .form-check-input {
            margin-right: 2px;
        }
        .set-select {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a class="bg-danger p-3 text-white" href="../dashboard.php ">Back To the Dashboard</a>
    </div>
    
    <div class="container mt-5">
        <h2 class="mb-3">Paper GS</h2>
        <form id="questionnaireForm">
            <div class="form-group set-select">
                <label for="setSelect">Please select your set:</label>
                <select class="form-control" id="setSelect" name="setId">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>

            <div class="questions-container">
                <?php for ($col = 0; $col < 4; $col++): ?>
                    <div class="column">
                        <?php for ($i = 1 + 25 * $col; $i <= 25 * ($col + 1); $i++): ?>
                        <div class="question">
                            <span class="question-label">Q<?php echo $i; ?></span>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="responses[<?php echo $i; ?>]" id="question<?php echo $i; ?>A" value="A">
                                <label class="form-check-label" for="question<?php echo $i; ?>A">A</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="responses[<?php echo $i; ?>]" id="question<?php echo $i; ?>B" value="B">
                                <label class="form-check-label" for="question<?php echo $i; ?>B">B</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="responses[<?php echo $i; ?>]" id="question<?php echo $i; ?>C" value="C">
                                <label class="form-check-label" for="question<?php echo $i; ?>C">C</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="responses[<?php echo $i; ?>]" id="question<?php echo $i; ?>D" value="D">
                                <label class="form-check-label" for="question<?php echo $i; ?>D">D</label>
                            </div>
                        </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>

    <!-- Modal HTML -->
    <div class="modal fade" id="resultsModal" tabindex="-1" aria-labelledby="resultsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultsModalLabel">Your Results</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Correct Answers: <span id="correct"></span><br>
                    Wrong Answers: <span id="wrong"></span><br>
                    Not Attempted: <span id="notAttempted"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
   document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('questionnaireForm');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch('submit_answers.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok. Status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            document.getElementById('correct').textContent = data.correct;
            document.getElementById('wrong').textContent = data.wrong;
            document.getElementById('notAttempted').textContent = data.notAttempted;
            $('#resultsModal').modal('show');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred, please check the console for details');
        });
    });
});
    </script>
</body>
</html>
