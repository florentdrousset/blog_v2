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

function updatePost() {
    $db = dbConnect();
    $query = $db->prepare('UPDATE Post SET Title = :title, Contents = :text, CreationTimeStamp = NOW(), Author_Id = :authorId, Category_Id = :categoryId WHERE Id= :id');
    $query->execute(array(
        'title' => $_POST['title'],
        'text' => $_POST['mainText'],
        'authorId' => $_POST['authorId'],
        'categoryId' => $_POST['categoryId'],
        'id' => $_POST['number']));
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
