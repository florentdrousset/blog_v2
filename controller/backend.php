<?php
/**
 * Created by PhpStorm.
 * User: florent
 * Date: 2019-03-05
 * Time: 11:20
 */

require_once './model/backend.php';

function getAdminContent() {
    $adminContent = adminContent();
    require './view/adminView.phtml';
}

function newPost() {
    $authorInfo = getAuthorInfo();
    $categoryInfo = getCategoryInfo();
    require './view/newPost.phtml';
}

function addPost($title, $text, $authorId, $categoryId) {
    insertNewPost($title, $text, $authorId, $categoryId);
    $postId = getLastPostId();
    header('Location: index.php?action=post&number='. $postId[0]);
}

function editPost($postId) {

}
