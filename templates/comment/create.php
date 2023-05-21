<?php
if (isset($article)) {
    $id = $article->getId();
} else {
    $id = '';
}
echo '
<h3>Добавить комментарий: </h3>
<form action="./comments" method="post">
    <label for="text">Текст:</label>
    <input id="text" type="text" name="text">
    <input id="article_id" type="text" name="article_id" value="' . $id . '">
    <button type="submit">Создать</button>
</form>
';
?>
