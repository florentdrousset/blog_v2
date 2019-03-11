<?php
/**
 * Created by PhpStorm.
 * User: florent
 * Date: 2019-03-02
 * Time: 17:56
 */

//C'est dans le routeur qu'on effectue les contrôles sur le GET reçu et qu'on redirige vers telle
//ou telle fonction du controller

require 'controller/frontend.php';
require 'controller/backend.php';

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['number']) && $_GET['number'] > 0) {
                post();
            }
            else {
                throw new Exception('L\id n\'a pas été trouvé');
            }
        }
        elseif ($_GET['action'] == 'admin') {
            getAdminContent();
        }
        elseif ($_GET['action'] == 'newPost') {
            if (!empty($_POST['title']) && !empty($_POST['mainText'])) {
                addPost($_POST['title'], $_POST['mainText'], $_POST['authorId'], $_POST['categoryId']);
            } else {
                newPost();
            }
        }
        elseif ($_GET['action'] == 'edit') {
            editPost($_GET['number']);
        }
        elseif ($_GET['action'] == 'addComment') {
            comment($_POST['nick'], $_POST['commentText'], $_GET['number']);
        }
        elseif ($_GET['action'] == 'update') {
            update($_GET['number'], $_POST['title'], $_POST['mainText'], $_POST['authorId'], $_POST['categoryId']);
        }
        elseif ($_GET['action'] == 'delete') {
            delete($_GET['number']);
        }
        else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }
    else {
        listPosts();
    }
} catch (Exception $e) {
    require 'view/error/errorView.phtml';
}
