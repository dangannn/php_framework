<?php include __DIR__ . "/../header.php";
?>
<h2>Создать статью</h2>
<!--<form action="../../src/Controllers/ArticleController.php" method="post">-->
<form action="" method="post">
    <label for="title">Заголовок:</label>
    <input id="title" type="text" name="title">
    <label for="text">Текст:</label>
    <input id="text" type="text" name="text">
    <button type="submit">Создать</button>
</form>

<?php include __DIR__ . "/../footer.html"; ?>
