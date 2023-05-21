<?php include __DIR__ . "/../header.php";
?>
<h2><?= $article->getTitle(); ?></h2>
<span>Опубликован: <?= $article->getDate(); ?></span>
<p><?= $article->getText(); ?></p>
<p>Автор: <?= $article->getAuthorId()->getNickname() ?></p>
<h3>Комментарии</h3>
<?php
$tmp = $article->getId();
include __DIR__ . "/../../templates/comment/create.php";

?>

<?php
if (isset($comments)) {
    foreach ($comments as $comment): ?>
        <p><?= $comment->getAuthorId()->getNickname(); ?></p>
        <p><?= $comment->getText(); ?></p>
        <?php echo '<a href="../comments/' . $comment->getId() .'/edit">изменить</a>' ?>
    <?php endforeach;
}
?>

<?php include __DIR__ . "/../footer.html"; ?>
