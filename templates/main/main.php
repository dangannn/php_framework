<?php include __DIR__ . "/../header.php"; ?>


<?php foreach ($articles as $article): ?>
    <div class="rounded-md bg-[#FFFFFF] px-4 max-h-36 overflow-hidden">
        <h2 class="font-bold text-xl"><a href="articles/show/<?= $article->getId(); ?>"><?= $article->getTitle(); ?></a>
        </h2>
        <p class="text-[#707EAE]"><?= $article->getText(); ?></p>
    </div>
<?php endforeach; ?>




<?php include __DIR__ . "/../footer.html"; ?>
