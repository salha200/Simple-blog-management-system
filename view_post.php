<?php
require_once 'Database.php';
require_once 'Post.php';

$db = new Database();
$post = new Post($db->connect());

if (isset($_GET['id'])) {
    $postDetails = $post->read($_GET['id']);
} else {
    echo "No post ID specified.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">View Post</h1>
        <?php if ($postDetails): ?>
            <table class="table table-bordered">
                <tr>
                    <th>Title</th>
                    <td><?php echo htmlspecialchars($postDetails['title']); ?></td>
                </tr>
                <tr>
                    <th>Content</th>
                    <td><?php echo (htmlspecialchars($postDetails['content'])); ?></td>
                </tr>
                <tr>
                    <th>Author</th>
                    <td><?php echo htmlspecialchars($postDetails['author']); ?></td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td><?php echo htmlspecialchars($postDetails['created_at']); ?></td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td><?php echo htmlspecialchars($postDetails['updated_at']); ?></td>
                </tr>
            </table>
            <div class="mt-3">
                <a href="edit_post.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary">Edit Post</a>
                <a href="delete_post.php?id=<?php echo $_GET['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');" class="btn btn-danger">Delete Post</a>
                <a href="list_posts.php" class="btn btn-secondary">Back to List</a>
            </div>
        <?php else: ?>
            <p class="alert alert-warning">Post not found.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
