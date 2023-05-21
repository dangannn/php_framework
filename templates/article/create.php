<?php include __DIR__ . "/../header.php";
?>
<div class="bg-[#00DEA3]/20 p-8 rounded-lg mb-4">
    <h2 class="font-bold text-center text-lg">Создать статью</h2>
    <form action="" method="post" class="flex flex-col">
        <label for="title">Заголовок:</label>
        <input class="text-[#707EAE] rounded-lg p-2" id="title" type="text" name="title">
        <label for="text">Текст:</label>
        <input class="text-[#707EAE] rounded-lg p-2" id="text" type="text" name="text">
        <button class="rounded-lg bg-[#783EFD] mt-4 p-2 max-w-fit mx-auto text-white" type="submit">Создать</button>
    </form>
</div>
<?php include __DIR__ . "/../footer.html"; ?>
