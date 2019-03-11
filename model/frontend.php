<?php

require_once 'config.php';

function getPost($postId) {
    $db = dbConnect();
    $query = $db->prepare('SELECT Title, Contents, FirstName, LastName, Name, Post.Id
    FROM Post
    INNER JOIN Author
    ON Post.Author_Id = Author.Id
    INNER JOIN Category
    ON Post.Category_Id = Category.Id
    WHERE Post.Id = ?');

    $query->execute(array($postId));
    $post = $query->fetch();
    $query->errorInfo();
    return $post;
}

function getPosts() {
    $db = dbConnect();
    $query = $db->prepare('SELECT Id, Title, Contents, CreationTimeStamp, Author_Id
    FROM Post');

    $query->execute();
    return $query->fetchAll();
}

function getComments($postId) {
    $db = dbConnect();
    $query = $db->prepare('SELECT Id, NickName, Contents, CreationTimestamp, Post_Id
    FROM Comment
    WHERE Post_Id = ?');
    $query->execute(array($postId));
    return $query->fetchAll();
}

function addComments($nick, $text, $id) {
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO Comment (NickName, Contents, CreationTimestamp, Post_Id) VALUES (?, ?, NOW(), ?)');
    $query->execute(array($nick, $text, $id));
}

?>
