<?php include __DIR__ . "/../header.php";
?>
<div class="bg-white rounded-lg p-4">
    <h2 class="font-bold text-2xl"><?= $article->getTitle(); ?></h2>
    <span>Опубликован: <?= $article->getDate(); ?></span>
    <p class=" my-4 border-t-2 border-[#783EFD]"><?= $article->getText(); ?></p>
    <p class="border-b-2 border-[#783EFD]">Автор: <span
                class="font-bold"><?= $article->getAuthorId()->getNickname() ?> </span></p>
    <h3 class="font-bold text-xl">Комментарии</h3>

    <?php
    $tmp = $article->getId();
    include __DIR__ . "/../../templates/comment/create.php";

    ?>

    <?php
    echo '<div class="flex flex-col gap-4">';
    if (isset($comments)) {
        foreach ($comments

                 as $comment): ?>
            <div class="bg-[#783EFD]/70 rounded-lg p-4 text-white">
                <p class="font-bold text-2xl"><?= $comment->getAuthorId()->getNickname(); ?></p>
                <p><?= $comment->getText(); ?></p>
                <?php echo '<a href="../comments/' . $comment->getId() . '/edit">изменить</a>' ?>
            </div>
        <?php endforeach;
    }
    echo '</div>';
    ?>

    <?php include __DIR__ . "/../footer.html"; ?>
