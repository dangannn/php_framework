<?php
if (isset($comment)) {
    echo '
<h3>Изменить комментарий: </h3>
<form action="" method="post">
    <label for="text">Текст:</label>
    <input id="text" type="text" name="text" value="' . $comment->getText() . '">
    <input id="article_id" type="text" name="article_id" value="' . $comment->getArticleId() . '">
    <button type="submit">Создать</button>
</form>
';
}
?>
