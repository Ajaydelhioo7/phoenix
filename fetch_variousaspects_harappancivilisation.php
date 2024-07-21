<?php
require 'db_connect.php';
require 'db.php';

$tag_id = isset($_GET['tag_id']) ? intval($_GET['tag_id']) : 0;

// Fetch the tag ID for "harappan Civilistion"
$sql = "SELECT id FROM tags WHERE tagName = 'Harappan Civilisation' OR parentTagName = 'Harappan Civilisation'";
$result = $conn->query($sql);

$tag_ids = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tag_ids[] = $row['id'];
    }
}

if ($tag_id > 0) {
    $tag_ids[] = $tag_id;
}

$tag_ids_string = implode(",", $tag_ids);

$sql = "SELECT q.*, t.tagName FROM questions q 
        JOIN tags t ON q.taglist_id = t.id 
        WHERE q.taglist_id IN ($tag_ids_string)";

$result = $conn->query($sql);

$questions = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();

echo json_encode($questions);
?>
