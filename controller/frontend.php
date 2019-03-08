<?php

require_once './model/frontend.php';

function listPosts() {
    $allArticles = getPosts();
    require './view/indexView.phtml';
}

function post() {
    $article = getPost($_GET['number']);
    $comments = getComments($_GET['number']);
    require './view/postView.phtml';
}

