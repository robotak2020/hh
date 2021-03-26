<?php

// white list routes

use System\Application;

$app = Application::getInstance();

if (strpos($app->request->url(), '/admin') === 0 ) {
    // check if the current url started with /admin
    // if so, then call our middlewares
    $app->route->callFirst(function ($app) {
        $app->load->action('Admin/Access', 'index');
    });

    // share admin layout
    $app->share('adminLayout', function ($app) {
        return $app->load->controller('Admin/Common/Layout');
    });
} else {
    // share news layout
    $app->share('newsLayout', function ($app) {
        return $app->load->controller('news/Common/Layout');
    });

    // share exam layout
    $app->share('examLayout', function ($app) {
        return $app->load->controller('exam/Common/Layout');
    });

    // share|load settings for each request
    $app->share('settings', function ($app) {
        $settingsModel = $app->load->model('Settings');

        $settingsModel->loadAll();

        return $settingsModel;
    });
}

// Admin Routes                 
$app->route->add('/admin/login', 'Admin/Login');
$app->route->add('/admin/login/submit', 'Admin/Login@submit', 'POST');


// dashboard
$app->route->add('/admin' , 'Admin/Dashboard');
$app->route->add('/admin/dashboard' , 'Admin/Dashboard');
$app->route->add('/admin/submit' , 'Admin/Dashboard@submit', 'POST');

// admin => users
$app->route->add('/admin/users', 'Admin/Users');
$app->route->add('/admin/users/add', 'Admin/Users@add', 'POST');
$app->route->add('/admin/users/submit', 'Admin/Users@submit', 'POST');
$app->route->add('/admin/users/edit/:id', 'Admin/Users@edit', 'POST');
$app->route->add('/admin/users/save/:id', 'Admin/Users@save' , 'POST');
$app->route->add('/admin/users/delete/:id', 'Admin/Users@delete', 'POST');

// admin => user profile
$app->route->add('/admin/profile/update', 'Admin/Profile@update' , 'POST');

// admin => users groups
$app->route->add('/admin/users-groups', 'Admin/UsersGroups');
$app->route->add('/admin/users-groups/add', 'Admin/UsersGroups@add', 'POST');
$app->route->add('/admin/users-groups/submit', 'Admin/UsersGroups@submit', 'POST');
$app->route->add('/admin/users-groups/edit/:id', 'Admin/UsersGroups@edit', 'POST');
$app->route->add('/admin/users-groups/save/:id', 'Admin/UsersGroups@save' , 'POST');
$app->route->add('/admin/users-groups/delete/:id', 'Admin/UsersGroups@delete', 'POST');

// admin => posts
$app->route->add('/admin/posts', 'Admin/Posts');
$app->route->add('/admin/posts/add', 'Admin/Posts@add', 'POST');
$app->route->add('/admin/posts/submit', 'Admin/Posts@submit', 'POST');
$app->route->add('/admin/posts/edit/:id', 'Admin/Posts@edit', 'POST');
$app->route->add('/admin/posts/save/:id', 'Admin/Posts@save' , 'POST');
$app->route->add('/admin/posts/delete/:id', 'Admin/Posts@delete', 'POST');

// Admin => Comments
//$app->route->add('/admin/posts/:id/comments', 'Admin/Comments');
//$app->route->add('/admin/comments/edit/:id', 'Admin/Comments@edit');
//$app->route->add('/admin/comments/save/:id', 'Admin/Comments@save', 'POST');
//$app->route->add('/admin/comments/delete/:id', 'Admin/Comments@delete');


// Admin Categories Routes
$app->route->add('/admin/categories', 'Admin/Categories');
$app->route->add('/admin/categories/add', 'Admin/Categories@add', 'POST');
$app->route->add('/admin/categories/submit', 'Admin/Categories@submit', 'POST');

$app->route->add('/admin/categories/edit/:id', 'Admin/Categories@edit', 'POST');
$app->route->add('/admin/categories/save/:id', 'Admin/Categories@save' , 'POST');
$app->route->add('/admin/categories/delete/:id', 'Admin/Categories@delete', 'POST');

// Admin settings
$app->route->add('/admin/settings', 'Admin/Settings');
$app->route->add('/admin/settings/save', 'Admin/Settings@save', 'POST');

// Admin Contacts
$app->route->add('/admin/contacts', 'Admin/Contacts');
$app->route->add('/admin/contacts/reply/:id', 'Admin/Contacts@reply');
$app->route->add('/admin/contacts/send/:id', 'Admin/Contacts@send' , 'POST');

// logout
$app->route->add('/admin/logout', 'Admin/Logout');


// news Routes
$app->route->add('/', 'news/Home'); // Home Page
$app->route->add('/blog', 'news/blog'); // Home Page
$app->route->add('/category/:text/:id', 'news/Category');
$app->route->add('/post/:text/:id', 'news/Post');
$app->route->add('/lang/:text', 'news/language');
$app->route->add('/post/:text/:id/add-comment', 'news/Post@addComment', 'POST');
$app->route->add('/register', 'news/Register');
$app->route->add('/register/submit', 'news/Register@submit', 'POST');
$app->route->add('/login', 'news/Login');
$app->route->add('/login/submit', 'news/Login@submit', 'POST');
$app->route->add('/logout', 'news/Logout');
$app->route->add('/contact-us', 'news/Contact');
$app->route->add('/contact-us/submit', 'news/Contact@submit', 'POST');
$app->route->add('/about-us', 'news/About');
$app->route->add('/team', 'news/Team');
//$app->route->add('/search', 'news/Search');

// exam Routes
$app->route->add('/exam', 'exam/Home'); // Home Page


// Not Found Routes
$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');