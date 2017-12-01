<?php if(!empty($model->apartments)): ?>
    <h2>Найденные квартиры</h2>

    <div class="table-wrapper">
        <table class="alt">
            <thead>
            <tr>
                <th title="Кол-во комнат">Ком</th>
                <th>Адрес</th>
                <th>Метро</th>
                <th>Цена</th>
                <th>Этаж</th>
                <th>Тип дома</th>
                <th>Площадь общая (жилая/кухня)</th>
                <th>Санузел</th>
                <th>Субъект</th>
                <th>Контакт</th>
                <th>Доп. сведения</th>
            </tr>
            </thead>
            <tbody>

            <?php foreach($model->apartments as $item): ?>
                <tr>
                    <td><?= $item->kkv?></td>
                    <td><?= ($item->region == '-'? '': $item->region . ', ') . $item->address?></td>
                    <td><?= $item->metroName?></td>
                    <td><?= $item->price?></td>
                    <td><?= $item->floor . ' из ' . $item->roomsOffered ?></td>
                    <td><?= $item->building?></td>
                    <td><?= $item->totalArea . ' (' . $item->livingArea . '/' . $item->kitchenArea . ')'?></td>
                    <td><?= $item->bathroom?></td>
                    <td><?= $item->seller?></td>
                    <td><?= $item->phone?></td>
                    <td><?= $item->description?></td>

                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
<?php else: ?>
    <?php if(!empty($model->errorMsg)): ?>
        <h3>Не правильно указаны данные формы!</h3>
        <div class="error-wrapper">
            <?php foreach($model->errorMsg as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="error-wrapper">По данному запросу квартиры не найдены!</div>
    <?php endif; ?>
<?php endif; ?>