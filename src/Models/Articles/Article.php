<?php

namespace Models\Articles;

use Models\Users\User;
use Models\ActiveRecordEntity;

class Article extends ActiveRecordEntity
{
    protected $authorId;
    protected $title;
    protected $text;
    protected $createdAt;

    public function getAuthorId(): User
    {
        // LazyLoad (ленивая загрузка)
        // – это когда данные не подгружаются до тех пор,
        // пока их не запросят.
        return User::getById($this->authorId);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getText()
    {
        return $this->text;

    }
    public function getDate()
    {
        return $this->createdAt;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
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

    public static function getTableName(): string
    {
        return 'articles';
    }
}
