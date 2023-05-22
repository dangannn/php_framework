<?php

namespace Controllers;

use Models\Articles\Article;
use Models\Users\User;
use View\View;
use Services\Db;
use Models\Comments\Comment;

class CommentController
{

    private $view;
    private $db;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
        $this->db = Db::getInstance();
    }


    public function add(): void
    {
        var_dump($_POST['text']);
        var_dump($_POST['article_id']);
        $this->view->renderHtml('comment/create.php', []);

        if (isset($_POST['text'])) {
            $comment = new Comment();

            $comment->setText($_POST['text']);

            $article = Article::getById((int)$_POST['article_id']);
            $comment->setArticle($article);

            $author = $article->getAuthorId();
            $comment->setAuthor($author);


            $comment->setDate(date("Y-m-d H:i:s"));

            $comment->save();
            header("Location: ../show/" . $_POST['article_id']);
        }
    }

    public function edit(int $commentId): void
    {
        $comment = Comment::getById($commentId);
        $this->view->renderHtml('comment/show.php', ['comment' => $comment]);
        $this->view->renderHtml('comment/edit.php', ['comment' => $comment]);
        if (isset($_POST['text'])) {
            $comment->setText($_POST['text']);
            $comment->setDate(date("Y-m-d H:i:s"));
            $comment->save();
            header("Location: ../../show/" . $comment->getArticleId());
        }
    }

    public function delete(int $commentId): void
    {
        if (isset($_POST['comment_delete']) && $_POST['comment_delete'] == '1') {
            $comment = Comment::getById($commentId);
            $comment->delete();
            header("Location: ../../show/" . $comment->getArticleId());
        }
    }
}
