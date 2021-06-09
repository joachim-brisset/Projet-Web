<header>
    <p> Trésorerie </p>
</header>
<section id="event-container" >
    <div id="in-progress-event-container" class="container">
        <p class="title"> Recettes </p><br>
            <?php $all_profits = 0; ?>
        <div class="result">
            
            <p>Profits sur les événements :</p>
            <?php
                foreach ($eventAll as $events) {
                    $registrations = Registration::with(['event_id' => $events['id']]);
                    echo $events['name']." : ".sizeof($registrations)." inscription(s) => ".($events['price']*sizeof($registrations))."€<br>";
                    $all_profits += ($events['price']*sizeof($registrations));
                }
            ?>
            <br><p>Profits sur la boutique :</p>
            <?php
                foreach ($allProducts as $products) {
                    echo $products['name']." : ".($products['price']*($products['initial_stock']-$products['stocks']))."€ (".($products['initial_stock']-$products['stocks'])." article(s) vendu(s))<br>";
                    $all_profits += ($products['price']*($products['initial_stock']-$products['stocks']));
                }
            ?>
            <br><p>Profits sur les inscriptions :</p>
            <?php 
                $staff = 0;
                $staff2 = 0;
                $membre = 0;
                foreach ($allUsers as $user) {
                    if ($user['role_id'] == 1) {
                        $membre += 1;
                    }
                    elseif ($user['role_id'] == 2) {
                        $staff += 1;
                    }
                    elseif ($user['role_id'] == 3) {
                        $staff2 += 1;
                    }
                }
                echo $membre." simple(s) membre(s) : ".($membre_price*$membre)."€<br>";
                echo $staff." membre(s) du staff : ".($staff_price*$staff)."€<br>";
                echo $staff2." membre(s) du staff ayant accès à la trésorerie : ".($staff2_price*$staff2)."€<br>";
                $all_profits += (($membre_price*$membre)+($staff_price*$staff)+($staff2_price*$staff2));
            ?>
            <br><p>Total des recettes sur la période :</p>
            <?php echo $all_profits."€"; ?>
        </div>
    </div>
    <div id="next-event-container"  class="container">
        <p class="title"> Dépenses </p><br>
            <?php $all_expenses = 0; ?>
        <div class="result">
            
            <p>Dépenses sur les événements :</p>
            <?php
                foreach ($eventAll as $events) {
                    echo $events['name']." : ".$events['event_cost']."€<br>";
                    $all_expenses += $events['event_cost'];
                }
            ?>
            <br><p>Dépenses sur la boutique :</p>
            <?php
                foreach ($allProducts as $products) {
                    echo $products['name']." : ".($products['price']*3/4)."€ (nombre d'articles : ".$products['initial_stock'].")<br>";
                    $all_expenses += ($products['price']*3/4*$products['initial_stock']);
                }
            ?>
            <br><p>Total des dépenses sur la période :</p>
            <?php echo $all_expenses."€"; ?>
        </div>
    </div>

    <div id="event-stats"  class="container">
        <p class="title"> Retour sur la période </p><br>
        <div class="result">
            <p> Solde au début de la période : 15 000 € </p>
            <p> Solde aujourd'hui :  <?php echo (15000-$all_expenses+$all_profits)."€"; ?></p>
        </div>
    </div>
</section>