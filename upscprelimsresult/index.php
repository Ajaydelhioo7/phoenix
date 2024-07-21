<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UPSC Prelims Result</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <style>
      html,
      body {
        font-family: "Fira Sans", sans-serif;
        font-weight: 300;
        font-style: normal;
      }

      h2,
      h3 {
        margin: 10px;
      }

      .container {
        margin-top: 50px;
      }

      .form-label {
        font-weight: 500;
      }

      .form-check-input {
        margin-top: 0.3rem;
      }

      .btn-primary {
        background-color: #ff7f00;
        border-color: #ff7f00;
      }

      .btn-primary:hover {
        background-color: #e67300;
        border-color: #e67300;
      }

      .btn-secondary {
        background-color: #ff7f00;
        border-color: #ff7f00;
      }

      .btn-secondary:hover {
        background-color: #e67300;
        border-color: #e67300;
      }

      .alert-info {
        background-color: #fff3cd;
        border-color: #ffeeba;
        color: #856404;
      }
      img {
        height: 100px;
        width: 300px;
        text-align: center;
        margin-bottom: 30px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h2 class="mb-3 text-primary text-center">
        Enter Your UPSC Prelims Details
      </h2>
      <h3 class="text-center mb-4">
        Let's know the cutoff from UPSC Community
      </h3>
      <p class="text-center mb-4">
        This is a unique effort from 99Notes, trying to get the cut off. We are
        trying to get at least 1 lac entries, accordingly we will release the
        data.
      </p>
      <ol class="mb-4">
        <li>Fill all columns and details.</li>
        <li>
          Make sure all the data and every information you provide is correct.
        </li>
        <li>
          At the end, this initiative will help at least lacs of aspirants to
          know by what difference they were out of the list.
        </li>
        <li>Share with your genuine friends and groups only.</li>
      </ol>
      <div id="submissionCounter" class="alert alert-info p-4">
        Total Submissions: Loading...
      </div>
      <form id="prelimsForm">
        <div class="mb-3">
          <label for="yearSelect" class="form-label">Select Year:</label>
          <select class="form-select" id="yearSelect" name="year" required>
            <option value="2024">2024</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="rollNumber" class="form-label">Roll Number:</label>
          <input
            type="text"
            class="form-control"
            id="rollNumber"
            name="rollNumber"
            required
          />
        </div>
        <div class="mb-3">
          <label for="score" class="form-label">
            Your average score according to any major 3 answer keys:
          </label>
          <input
            type="number"
            class="form-control"
            id="score"
            name="score"
            required
          />
        </div>
        <div class="mb-3">
          <label class="form-label">Have you cleared prelims 2024?</label>
          <div>
                   
        
            <div class="form-check form-check-inline">
              <input
                type="radio"
                id="clearedYes"
                name="cleared"
                value="yes"
                class="form-check-input"
                required
              />
              <label class="form-check-label" for="clearedYes">Yes</label>
            </div>
            <div class="form-check form-check-inline">
              <input
                type="radio"
                id="clearedNo"
                name="cleared"
                value="no"
                class="form-check-input"
                required
              />
              <label class="form-check-label" for="clearedNo">No</label>
            </div>
            <div class="mb-3 mt-3">
          <a href="https://99notes.in/wp-content/uploads/2024/07/upsc-prelims-result-2024-99Notes.pdf" class="btn btn-info" target="_blank"
            >Check your result now</a
          >
        </div> 
          </div>
        </div>
        <div class="mb-3">
          <label for="cutoffEstimate" class="form-label">
            What's the cutoff as per you and your friends?
          </label>
          <input
            type="number"
            class="form-control"
            id="cutoffEstimate"
            name="cutoffEstimate"
            required
          />
        </div>
        <button type="button" class="btn btn-primary" id="submitPrelimsButton">
          Submit
        </button>
      </form>
      <div id="feedbackMessage" class="mt-3"></div>
    </div>

    <!-- Bootstrap Modal for additional details -->
    <div
      class="modal fade"
      id="detailsModal"
      tabindex="-1"
      aria-labelledby="detailsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailsModalLabel">
              Additional Information
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form id="additionalInfoForm">
              <input type="hidden" id="hiddenRollNumber" name="rollNumber" />
              <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  required
                />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  required
                />
              </div>
              <button
                type="button"
                class="btn btn-primary"
                id="submitAdditionalInfoButton"
              >
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
          <div class="img mt-3 mb-3">
            <a href="https://99notes.in/"
              ><img
                src="https://99notes.in/wp-content/uploads/2024/02/cropped-99notes-logo-.webp"
                alt=""
            /></a>
          </div>
        </div>
        <div class="col-4"></div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function () {
        fetchCounter();

        function fetchCounter() {
          $.ajax({
            url: "getCounter.php",
            type: "GET",
            dataType: "json",
            success: function (data) {
              if (data.count) {
                updateCounter(data.count);
              }
            },
            error: function () {
              $("#submissionCounter").text("Failed to load submission count.");
            },
          });
        }

        function updateCounter(newCount) {
          $("#submissionCounter").text("Total Submissions: " + newCount);
        }

        function displayMessage(message, type) {
          var alertClass =
            type === "success" ? "alert-success" : "alert-danger";
          $("#feedbackMessage")
            .removeClass("alert-success alert-danger")
            .addClass(alertClass)
            .text(message)
            .show();
        }

        $("#submitPrelimsButton").click(function () {
          $.ajax({
            type: "POST",
            url: "submit.php",
            data: $("#prelimsForm").serialize(),
            success: function (response) {
              var responseParts = response.split(". ");
              updateCounter(responseParts[responseParts.length - 1]);
              $("#hiddenRollNumber").val($("#rollNumber").val());
              $("#detailsModal").modal("show");
              displayMessage(responseParts[0], "success");
            },
            error: function () {
              displayMessage(
                "Failed to submit prelims data. Please try again.",
                "error"
              );
            },
          });
        });

        $("#submitAdditionalInfoButton").click(function () {
          $.ajax({
            type: "POST",
            url: "submit.php",
            data: $("#additionalInfoForm").serialize(),
            success: function (response) {
              var responseParts = response.split(". ");
              updateCounter(responseParts[responseParts.length - 1]);
              $("#detailsModal").modal("hide");
              displayMessage(responseParts[0], "success");
            },
            error: function () {
              displayMessage(
                "Failed to submit additional info. Please try again.",
                "error"
              );
            },
          });
        });
      });
    </script>
  </body>
</html>