<?php
if (isset($comment)) {
    echo '
<div class="bg-[#00DEA3]/20 p-8 rounded-lg mb-4">
<h3>Изменить комментарий: </h3>
<form action="" method="post" class="flex w-full items-center">
    <label for="text">Текст:</label>
    <input  class="w-full text-[#707EAE] rounded-lg p-2" id="text" type="text" name="text" value="' . $comment->getText() . '">
    <input class="hidden" id="article_id" type="text" name="article_id" value="' . $comment->getArticleId() . '">
    <button class="rounded-lg bg-[#783EFD] p-2 max-w-fit text-white" type="submit">Создать</button>
</form>
</div>
';
}
?>
