<!DOCTYPE html>
<html>
<head>
    <title>Prototype Input</title>
    <script>
        function updateParentTagDetails() {
            var parentTagSelector = document.getElementById("parentTagNameSelect");
            var selectedOption = parentTagSelector.options[parentTagSelector.selectedIndex];
            document.getElementById("parentTagId").value = selectedOption.value; // The value is the tag ID
            document.getElementById("parentTagName").value = selectedOption.text; // The text is the tag name
        }
    </script>
    <link rel="stylesheet" href="./users/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
    include './includes/header.php';
    include 'db.php';
    session_start();

    function validate_and_insert_master_tag($conn, $masterTag) {
        $stmt = $conn->prepare("SELECT id FROM master_tags WHERE masterTag = ?");
        $stmt->bind_param("s", $masterTag);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<div class='alert alert-warning'>Master tag already exists.</div>";
        } else {
            $stmt = $conn->prepare("INSERT INTO master_tags (masterTag) VALUES (?)");
            $stmt->bind_param("s", $masterTag);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Master tag inserted successfully.</div>";
            } else {
                echo "Error: " . $stmt->error . "<br>";
            }
        }

        $stmt->close();
    }

    function validate_and_insert_additional_tag($conn, $parentTagId, $parentTagName, $tagName, $user_id, $status, $ismastertag, $updatedTime) {
        $stmt = $conn->prepare("SELECT id FROM tags WHERE tagName = ?");
        $stmt->bind_param("s", $tagName);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<div class='alert alert-warning'>Tag name already exists.</div>";
        } else {
            $stmt = $conn->prepare("INSERT INTO tags (parentTagId, parentTagName, tagName, addedBy, updatedBy, status, ismastertag, updatedTime) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issiiisi", $parentTagId, $parentTagName, $tagName, $user_id, $user_id, $status, $ismastertag, $updatedTime);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Additional details inserted successfully.</div>";
            } else {
                echo "Error: " . $stmt->error . "<br>";
            }
        }

        $stmt->close();
    }

    // Process Master Tag Form
    if (isset($_POST['masterTag']) && !empty($_POST['masterTag'])) {
        $masterTag = $_POST['masterTag'];
        validate_and_insert_master_tag($conn, $masterTag);
    }

    // Process Additional Inputs Form
    if (isset($_POST['tagName'], $_POST['ismastertag'])) {
        $parentTagName = $_POST['parentTagName'] ?? null;
        $parentTagId = $_POST['parentTagId'] ?? null;
        $tagName = $_POST['tagName'];
        $ismastertag = $_POST['ismastertag'];

        // Assuming the 'addedBy' and 'updatedBy' will be taken from the session or a default value
        $user_id = $_SESSION['user_id'] ?? 1; // Example: defaulting to user with ID 1

        // Assuming status is true when a new tag is created
        $status = 1; // Status is active (1) when created

        // Getting the current timestamp for 'updatedTime'
        $updatedTime = date('Y-m-d H:i:s'); // Current timestamp in Y-m-d H:i:s format (hours:minutes:seconds)

        validate_and_insert_additional_tag($conn, $parentTagId, $parentTagName, $tagName, $user_id, $status, $ismastertag, $updatedTime);
    }

    $conn->close();
    ?>
    <div class="container mt-5 p-5">
        <div class="box1">
            <h2>Master Tag Form</h2>
            <form action="add_tags.php" method="POST">
                <label for="masterTag">Master Tag:</label>
                <input type="text" id="masterTag" name="masterTag">
                <input type="submit" value="Submit">
            </form>
        </div>
        <div class="box2 mt-5">
            <h2>Additional Tag Details</h2>
            <form action="add_tags.php" method="POST">
                <label for="parentTagName">Parent Tag Name:</label>
                <select id="parentTagNameSelect" name="parentTagNameSelect" onchange="updateParentTagDetails()">
                    <option value="">Select a tag</option>
                    <?php
                    include 'db.php';
                    $query = "SELECT id, masterTag FROM master_tags UNION SELECT id, tagName AS masterTag FROM tags ORDER BY masterTag";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='".$row["id"]."'>".$row["masterTag"]."</option>";
                        }
                    } else {
                        echo "<option value=''>No tags found</option>";
                    }
                    $conn->close();
                    ?>
                </select>
                <input type="hidden" id="parentTagId" name="parentTagId">
                <input type="hidden" id="parentTagName" name="parentTagName">
                <label for="tagName">Tag Name:</label>
                <input type="text" id="tagName" name="tagName">
                <label for="ismastertag">Is Master Tag:</label>
                <select id="ismastertag" name="ismastertag">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
