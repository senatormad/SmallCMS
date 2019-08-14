<?php

function home_posts($articles)
{
    foreach ($articles as $artical){
        require 'templates/home_post.php';
    }

}

function single_post($article)
{
    require_once 'templates/single_post.php';

}

function edit_post($article)
{
    require_once 'templates/edit_post.php';

}

function login_page($login_error)
{
    require_once 'templates/login.php';

}