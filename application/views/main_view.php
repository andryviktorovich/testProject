<?php
/* @var $model \Model_Main */

?>
<section>

    <header class="main">
        <h1>Форма поиска</h1>
    </header>

    <!-- form -->

    <form method="get" id="searchForm">
        <h3 class="label">Количество комнат</h3>
        <div class="row uniform">
            <div class="6u 12u$(xsmall)">
                <input type="number" name="roomsFrom" value="<?= $model->roomsFrom ?>" min="1" max="4" placeholder="Комнат от" />
            </div>
            <div class="6u$ 12u$(xsmall)">
                <input type="number" name="roomsTo" value="<?= $model->roomsTo ?>"  min="1" max="4"  placeholder="Комнат до" />
            </div>
        </div>

        <h3 class="label">Цена, тыс. ₽</h3>
        <div class="row uniform">
            <div class="6u 12u$(xsmall)">
                <input type="text" name="priceFrom" value="<?= $model->priceFrom ?>" placeholder="Цена от" />
            </div>
            <div class="6u$ 12u$(xsmall)">
                <input type="text" name="priceTo" value="<?= $model->priceTo ?>" placeholder="Цена до" />
            </div>
        </div>

        <h3 class="label">Метро</h3>
        <div class="12u$">
            <select name="metro[]" class="multiple" multiple>
                <?php foreach($model->getListMetro() as $key => $item): ?>
                    <option value="<?= $key?>" <?= in_array($key, $model->metro) ? 'selected' : '';?> > <?= $item?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- Break -->
        <div class="12u$">
            <ul class="actions label">
                <li><input type="submit" value="Найти" id="findApartments" class="special" /></li>
                <li class="ajax-loader" style="display: none"><img src="images/ajax-loader.gif"></li>
            </ul>
        </div>
    </form>

    <!---  RESULT --->

    <hr class="major" />

    <div class="searchResult">
        <?php include 'application/views/apartments_view.php'; ?>
    </div>
</section>