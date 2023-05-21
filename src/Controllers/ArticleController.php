<?php

namespace Controllers;


use Models\Comments\Comment;
use View\View;
use Services\Db;
use Models\Articles\Article;
use Models\Users\User;

class ArticleController
{

    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
        $this->db = Db::getInstance();
    }

    public function show(int $id)
    {
        $article = Article::getById($id);
        $comments = Comment::findAllByOption('article_id', $id);

        $this->view->renderHtml('article/show.php', ['article' => $article, 'comments' => $comments]);
    }

    public function edit(int $articleId): void
    {
        $article = Article::getById($articleId);
        if ($article === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $article->setTitle('Новое название статьи');

        $article->setText('Новый текст статьи');

        $article->save();
        var_dump($article);

    }

    public function add(): void
    {
        $this->view->renderHtml('article/create.php', []);

        if (isset($_POST['title']) || isset($_POST['text'])) {
            $article = new Article();

            $article->setTitle($_POST['title']);
            $article->setText($_POST['text']);

            $author = User::getById(1);
            $article->setAuthor($author);
            $article->setDate(date("Y-m-d H:i:s"));

            $article->save();
        }
    }
}
