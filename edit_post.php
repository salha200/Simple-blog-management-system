<?php
require_once 'Database.php';
require_once 'Post.php';

$db = new Database();
$post = new Post($db->connect());

if (isset($_GET['id'])) {
    $postDetails = $post->read($_GET['id']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->author = $_POST['author'];

        if (!empty($post->title) && !empty($post->content)) {
            $post->update($_GET['id']);
            header("Location: view_post.php?id={$_GET['id']}");
            exit();
        } else {
            echo "Please fill all fields!";
        }
    }
} else {
    echo "No post ID specified.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form method="POST">
        <label>Title:</label><br>
        <input type="text" name="title" value="<?php echo $postDetails['title']; ?>"><br>
        <label>Content:</label><br>
        <textarea name="content"><?php echo $postDetails['content']; ?></textarea><br>
        <label>Author:</label><br>
        <input type="text" name="author" value="<?php echo $postDetails['author']; ?>"><br>
        <input type="submit" value="Update Post">
    </form>
</body>
</html>
