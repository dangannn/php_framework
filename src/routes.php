<?php
return [
    '~hello/(.*)~' => [Controllers\MainController::class, 'sayHello'],
    '~^$~' => [Controllers\MainController::class, 'main'],
    '~articles/show/(\d+)~' => [Controllers\ArticleController::class, 'show'],
    '~^articles/(\d+)/edit$~' => [Controllers\ArticleController::class, 'edit'],
    '~^articles/add$~' => [Controllers\ArticleController::class, 'add'],
    '~articles/show/comments$~' => [Controllers\CommentController::class, 'add'],
    '~articles/comments/(\d+)/edit$~' => [Controllers\CommentController::class, 'edit'],
    '~articles/comments/(\d+)/delete$~' => [Controllers\CommentController::class, 'delete']
];
