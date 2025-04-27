<?php

require_once __DIR__ . '/../autoload.php';

use App\Models\Post;
use App\Models\User;

if (!$_GET['id']) {
    header('Location: /');
    exit();
}

$post = (new Post())
    -> searchById((int) $_GET['id']);
if (!$post -> getData()) {
    header('Location: /');
    exit();
}

$user = (new User())
    -> searchById((int) $post -> getData()['userId']);
if (!$user->getData()) {
    header('Location: /');
    exit();
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="./assets/main.css">
</head>
<body>
<main class="container max-w-sm mx-auto p-6">
        <h1 class="text-4xl font-bold text-center py-4"><?php print($post -> getData()['title']); ?></h1>
        <p class="text-center text-gray-500 mb-6">
            Author: <?php print($user -> getData()['name']); ?> (<?php print($user -> getData()['username']) ?>)<br>
            Company: <?php print($user -> getData()['company']['name']); ?><br>(<?php print($user -> getData()['company']['catchPhrase']) ?>)
        </p>
        <aside class="max-w-sm mx-auto my-10">
            <a href="/" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Return back</a>
        </aside>
        <section class="max-w-sm">
            <p><?php print(nl2br($post -> getData()['body'])); ?></p>
        </section>
    </main>
</body>
</html>
