<header>
    <p> Produits </p>
</header>
<section id="product-container">
    <div id="all-products-container" class="container">
        <p class="title"> Tous les produits </p>
        <div class="header">
            <input disabled name="product_name" value="Nom">
            <input disabled name="product_price" value="Prix">
            <input disabled name="product_stocks" value="Stocks">
            <input disabled name="product_initial_stock" value="Quantité">
            <input disabled class="sold" value="Vendu">
        </div>
        <div class="result">
    <?php $soldSum = 0;
    foreach ($allProducts as $product): ?>
            <div class="item">
                <form class="ajax-form">
                    <input hidden name="product_id" value="<?= $product['id'] ?>">
                    <input name="product_name" value="<?= $product['name'] ?>">
                    <input type="number" name="product_price" value="<?= $product['price'] ?>">
                    <input type="number" name="product_stocks" value="<?= $product['stocks'] ?>">
                    <input type="number" name="product_initial_stock" value="<?= $product['initial_stock'] ?>">
                    <input disabled class="sold" value="<?= $sold = $product['initial_stock'] - $product['stocks'] ?>">
                    <label>
                        <img src="/img/trash-icon.svg" alt="delete">
                        <input name="delete" type="checkbox" value="delete">
                    </label>
                    <input type="submit" value="editer">
                </form>
            </div>
    <?php $soldSum += $sold;
    endforeach; ?>
            <p> Ventes totales : <?= $soldSum ?> articles </p>
        </div>
    </div>

    <div id="add-product-container" class="container">
        <p class="title"> Ajouter un produit </p>
        <div class="header">
            <input disabled name="product_name" value="Nom">
            <input disabled name="product_price" value="Prix">
            <input disabled name="product_stocks" value="Stocks">
            <input disabled name="product_initial_stock" value="Qauntité">
        </div>
        <form class="ajax-form">
            <input name="product_name">
            <input type="number" name="product_price">
            <input type="number" name="product_stocks">
            <input type="number" name="product_initial_stock">
            <input type="submit" value="ajouter">
        </form>
    </div>
</section>
<script src="/js/adminpanel-product.js"></script>