<?php if ($_SERVER['REQUEST_URI'] == '/crud.php'):?>
    <div>
        <a href="index.php"><input type="submit" value="На главную"></a>
        <a href="actions/create.php"><input type="submit" value="Добавить игрока"></a>
        <a href="actions/clear.php"><input type="submit" value="Очистить все"></a>
    </div>
<?php endif;?>
<table class="table">
    <th>Место</th>
    <th>Игрок</th>
    <th>Ебало</th>
    <th>Очки</th>
    <th>Сыгранные партии</th>
    <th>Победы</th>
    <th>Ничьи</th>
    <th>Поражения</th>
    <?php if ($_SERVER['REQUEST_URI'] == '/crud.php'):?>
        <th>Изменить</th>
        <th>Удалить</th>
    <?php endif;?>
    <?php foreach ($players as $key => $player) :?>
        <tr>
            <td><?=$key+1?></td>
            <td><?=$player['name']?></td>
            <td>
                <?php if ($player['image']!=null):?>
                    <a href="view/ebalo.php?name=<?=$player['name']?>&image=<?=$player['image']?>">
                        <img src="uploads/<?=$player['image']?>" width="60px" height="60px">
                    </a>
                <?php else :?>
                    Нет
                <?php endif;?>
            </td>
            <td><?=$player['scores']?></td>
            <td><?=$player['games'];?></td>
            <td><?=$player['winers']?></td>
            <td><?=$player['draws']?></td>
            <td><?=$player['loses']?></td>
            <?php if ($_SERVER['REQUEST_URI'] == '/crud.php'):?>
                <td>
                    <a href="actions/edit.php?player=<?=$player['name']?>&id=<?=$player['id']?>">
                        <input type="submit" class="btn btn-block" value="Изменить">
                    </a>
                </td>
                <td>
                    <a href="actions/delete.php?id=<?=$player['id']?>">
                        <input type="submit" class="btn btn-danger" value="Удалить">
                    </a>
                </td>
            <?php endif;?>
        </tr>
    <?php endforeach;?>
</table>
