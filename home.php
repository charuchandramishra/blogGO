
<?php
include 'includes\database.php';
include 'includes\config.php';
include 'includes\function.php';
secure();
include 'includes\header.php'; 
?>

<div class="hero">
        <h1>Welcome to BlogGO</h1>
        <p>Manage your content seamlessly and efficiently.</p>
</div>
 <!-- Posts Section -->
 <div class="container my-5">
        <h2 class="mb-4">My Posts</h2>
        <div class="row">
            <?php
            // Include database connection
            include 'includes/database.php';

            // Fetch posts from the database
            $query = "SELECT * FROM posts ORDER BY date DESC";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">' . htmlspecialchars_decode($row['title']) . '</h5>
                                <p class="card-text">' . substr(htmlspecialchars_decode($row['content']), 0, 100) . '...</p>
                                <a href="posts.php?id=' . $row['id'] . '" class="btn btn-primary">Read More</a>
                                <p class="mt-2 text-muted">By: ' . htmlspecialchars($row['author']) . ' on ' . date("M d, Y", strtotime($row['date'])) . '</p>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<p class="text-center">No posts available.</p>';
            }

            $conn->close();
            ?>
        </div>
    </div>

<?php
include 'includes\footer.php';
?>    