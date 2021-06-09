<header>
    <p> Articles </p>
</header>
<section id="news-container">
    <div id="all-news-container" class="container">
        <p class="title"> Tous les articles </p><br>
        <div class="header">
            <input disabled name="news_title" value="Titre">
            <input disabled name="news_picture_url" value="Image">
            <input disabled name="news_corps" value="Article">
            <input disabled name="news_created_at" value="Date de publication">
        </div>
        <div class="result">
    <?php 
    if (empty($allNews)) {
        echo "<p> Aucun article enregistré </p>";
    }
    foreach ($allNews as $news): ?>
            <div class="item">
                <form class="ajax-form">
                    <input hidden name="news_id" value="<?= $news['id'] ?>">
                    <input name="news_title" value="<?= $news['title'] ?>">
                    <input name="news_picture_url" value="<?= $news['picture_url'] ?>">
                    <input name="news_corps" value="<?= $news['corps'] ?>">
                    <input name="news_created_at" value="<?= $news['created_at'] ?>" type="date">
                    <label>
                        <img src="/img/trash-icon.svg" alt="delete">
                        <input name="delete" type="checkbox" value="delete">
                    </label>
                    <input type="submit" value="editer">
                </form>
            </div>
    <?php endforeach; ?>
            <br><p> Nombre d'articles : <?= sizeof($allNews); ?> </p>
        </div>
    </div>

    <div id="add-news-container" class="container">
        <p class="title"> Ajouter un article </p><br>
        <div class="header">
            <input disabled name="news_title" value="Titre">
            <input disabled name="news_picture_url" value="Image">
            <input disabled name="news_corps" value="Article">
            <input disabled name="news_created_at" value="Date de publication">
        </div>
        <form class="ajax-form">
            <input name="news_title" required>
            <input name="news_picture_url" required>
            <input name="news_corps" required>
            <input name="news_created_at" type="date" required>
            <input type="submit" value="ajouter">
        </form>
    </div>
</section>
<script src="/js/adminpanel-news.js"></script>