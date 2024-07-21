<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Define the number of results per page
$results_per_page = 10; 

// Determine the current page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = (int)$_GET['page'];
} else {
    $page = 1;
}

// Calculate the starting limit
$start_limit = ($page - 1) * $results_per_page;

// Initialize the search term
$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
}

// Fetch tags with pagination and search
$sql = "SELECT t.id, t.tagName, t.parentTagName, t.addedBy, t.updatedBy, t.updatedTime, mt.masterTag
        FROM tags t
        LEFT JOIN master_tags mt ON t.parentTagId = mt.id
        WHERE t.tagName LIKE ?
        LIMIT ?, ?";
$stmt = $conn->prepare($sql);
$searchTermLike = '%' . $searchTerm . '%';
$stmt->bind_param("sii", $searchTermLike, $start_limit, $results_per_page);
$stmt->execute();
$result = $stmt->get_result();

// Determine the total number of pages available
$sqlTotal = "SELECT COUNT(*) AS total FROM tags WHERE tagName LIKE ?";
$stmtTotal = $conn->prepare($sqlTotal);
$stmtTotal->bind_param("s", $searchTermLike);
$stmtTotal->execute();
$resultTotal = $stmtTotal->get_result();
$rowTotal = $resultTotal->fetch_assoc();
$total_pages = ceil($rowTotal['total'] / $results_per_page);

// Fetch all master tags
$sqlMasterTags = "SELECT id, masterTag FROM master_tags";
$resultMasterTags = $conn->query($sqlMasterTags);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Tags</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include './includes/header.php'?>
    <div class="container mt-5">
        <h2>Manage Tags</h2>
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Search Form -->
        <form method="GET" action="manage_tags.php" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by tag name" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <table class="table table-light">
            <thead>
                <tr class="text-white">
                    <th>ID</th>
                    <th>Tag Name</th>
                    <th>Parent Tag Name</th>
                    <th>Added By</th>
                    <th>Updated By</th>
                    <th>Updated Time</th>
                    <th>Master Tag</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['tagName']; ?></td>
                            <td><?php echo $row['parentTagName']; ?></td>
                            <td><?php echo $row['addedBy']; ?></td>
                            <td><?php echo $row['updatedBy']; ?></td>
                            <td><?php echo $row['updatedTime']; ?></td>
                            <td><?php echo $row['masterTag']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No tags found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="manage_tags.php?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($searchTerm); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

        <h2>Manage Master Tags</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Master Tag</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultMasterTags->num_rows > 0): ?>
                    <?php while ($row = $resultMasterTags->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['masterTag']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No master tags found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
