<?php
if (isset($article)) {
    $id = $article->getId();
} else {
    $id = '';
}
echo '
<div class="bg-[#00DEA3]/20 p-8 rounded-lg mb-4">
<h3>Добавить комментарий: </h3>
<form action="./comments" method="post" class="flex w-full items-center">
    <label for="text">Текст:</label>
    <input class="w-full text-[#707EAE] rounded-lg p-2" id="text" type="text" name="text">
    <input class="hidden" id="article_id" type="text" name="article_id" value="' . $id . '">
    <button class="rounded-lg bg-[#783EFD] p-2 max-w-fit text-white" type="submit">Создать</button>
</form>
</div>
';
?>
