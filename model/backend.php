<?php
/**
 * Created by PhpStorm.
 * User: florent
 * Date: 2019-03-05
 * Time: 11:17
 */

require_once 'config.php';

function adminContent() {
    $db = dbConnect();
    $query = $db->prepare('SELECT Title, SUBSTR(Contents, 1, 30) AS Contents, FirstName, LastName, Name, Post.Id
    FROM Post 
    INNER JOIN Author
    ON Post.Author_Id = Author.Id 
    INNER JOIN Category
    ON Post.Category_Id = Category.Id');

    $query->execute();
    return $query->fetchAll();
}

function getAuthorInfo() {
    $db = dbConnect();
    $query = $db->prepare('SELECT Id, FirstName, LastName FROM Author');
    $query->execute();
    return $query->fetchAll();
}

function getCategoryInfo() {
    $db = dbConnect();
    $query = $db->prepare('SELECT * FROM Category');
    $query->execute();
    return $query->fetchAll();
}

function updatePost($postId, $title, $text, $authorId, $categoryId) {
    $db = dbConnect();
    $query = $db->prepare('UPDATE Post SET Title = :title, Contents = :text, CreationTimeStamp = NOW(), Author_Id = :authorId, Category_Id = :categoryId WHERE Id= :id');
    $query->execute(array(
        'title' => $title,
        'text' => $text,
        'authorId' => $authorId,
        'categoryId' => $categoryId,
        'id' => $postId));
}

function insertNewPost($title, $text, $authorId, $categoryId) {
    $db = dbConnect();
    $query = $db->prepare('INSERT INTO Post (Title, Contents, CreationTimeStamp, Author_Id, Category_Id) VALUES (?, ?, NOW(), ?, ?)');
    $query->execute(array($title, $text, $authorId, $categoryId));
}

function getLastPostId() {
    $db = dbConnect();
    $query = $db->prepare('SELECT Id FROM Post ORDER BY Id DESC');
    $query->execute();
    return $query->fetch();
}

function getPostData()
{
    $db = dbConnect();
    $query = $db->prepare('SELECT Id, Title, Contents FROM Post WHERE Id = ?');
    $query->execute(array($_GET['number']));
    return $query->fetch();
}