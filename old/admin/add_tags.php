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
    <?php include './includes/header.php'?>
    <div class="container mt-5  p-5">
        <div class="box1">

        <h2>Master Tag Form</h2>
        <form action="process.php" method="POST">
            <label for="masterTag">Master Tag:</label>
            <input type="text" id="masterTag" name="masterTag">
            <input type="submit" value="Submit">
        </form>
        </div>
        <div class="box2 mt-5" >

        <h2>Additional Tag Details</h2>
        <form action="process.php" method="POST">
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

            <!-- <label for="addedBy">Added By:</label>
            <input type="text" id="addedBy" name="addedBy"> -->

            <!-- <label for="updatedBy">Updated By:</label>
            <input type="text" id="updatedBy" name="updatedBy"> -->

            <!-- <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="true">True</option>
                <option value="false">False</option>
            </select> -->

            <!-- <label for="updatedTime">Updated Time:</label>
            <input type="time" id="updatedTime" name="updatedTime"> -->

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
