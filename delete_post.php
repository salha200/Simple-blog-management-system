<?php
require_once 'Database.php';
require_once 'Post.php';

$db = new Database();
$post = new Post($db->connect());

if (isset($_GET['id'])) {
    $post->delete($_GET['id']);
    header("Location: list_posts.php");
    exit();
} else {
    echo "No post ID specified.";
}
?>
