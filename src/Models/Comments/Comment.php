<?php

namespace Models\Comments;

use Models\Articles\Article;
use Models\Users\User;
use Models\ActiveRecordEntity;

class Comment extends ActiveRecordEntity
{
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    public function getAuthorId(): User
    {
        return User::getbyId($this->authorId);
    }

    public function getArticleId()
    {
        // LazyLoad (ленивая загрузка)
        // – это когда данные не подгружаются до тех пор,
        // пока их не запросят.
//        return Article::getById($this->articleId);
        return $this->articleId;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getDate()
    {
        return $this->createdAt;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function setDate(string $date)
    {
        $this->createdAt = $date;
    }

    public function setAuthor(User $author): void
    {
        $this->authorId = $author->getId();
    }

    public function setArticle(Article $article): void
    {
        $this->articleId = $article->getId();
    }


    public static function getTableName(): string
    {
        return 'comments';
    }

}
