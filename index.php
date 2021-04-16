<?php

include "DB.php";
session_start();
$db = new DB();
$players = $db->getPlayers();
$names = getPlayersNames($players);

if (isset($_POST['send']) && $_POST['send'] == "Отправить") {
    if (check($names)) {
        $results = [
            'winner' => $_POST['winner'],
            'second' => $_POST['second'],
            'loser' => $_POST['loser']
        ];
        $db->update($results);
    }
    header('Location:index.php');
}

function check($names) {
    if ($_POST['winner'] == "" || $_POST['second'] == "" || $_POST['loser'] == "") {
        $_SESSION['work'] = 'nothing';
        return false;
    } else if (
            !check_correct($names, $_POST['winner']) ||
            !check_correct($names, $_POST['second']) ||
            !check_correct($names, $_POST['loser'])
    ) {
        $_SESSION['work'] = 'not correct';
        return false;
    }
    $_SESSION['work'] = 'work';
    return true;
}

function check_correct ($names, $value) {
    foreach ($names as $name) {
        if ($name == $value) return true;
    }
    return false;
}

function getPlayersNames($players) {
    $names = [];
    foreach ($players as $player) {
        array_push($names, $player['name']);
    }
    return $names;
}
include "bootstrap/bootstrap.php";
?>

<body>
<div class="container">
    <h1>Таблица</h1>
    <a href="crud.php"><input type="submit" value="Изменить игроков" class="btn btn-success"></a>
    <?php include ('table.php');?>
    <?php if (isset($_SESSION['work'])&& $_SESSION['work']!= 'work'):?>
        <div class="alert alert-info">
            <p style="color: red">
                <?php if ($_SESSION['work'] == 'nothing') :?>
                    Заполните все поля!!!
                <?php endif;?>
                <?php if ($_SESSION['work'] == 'not correct') :?>
                    Заполните поля правильно!!!
                <?php endif;?>
            </p>
        </div>
    <?php endif;?>
    <form action="" method="post">
        <label>Победитель</label>:<input type="text" name="winner">
        <br>
        <label>Второе место</label>:<input type="text" name="second">
        <br>
        <label>Програвший</label>:<input type="text" name="loser">
        <br>
        <input type="submit" value="Отправить" class="btn btn-success" name="send">
    </form>
    <!--
    <input type="button" value="Иван" class="btn btn-info">
    <input type="button" value="Ваня" class="btn btn-info">
    <input type="button" value="Максим" class="btn btn-info">
    -->
    <?php foreach ($players as $player) :?>
        <input type="button" class="btn btn-info" value="<?=$player['name']?>">
    <?php endforeach;?>
    <br>
    <input type="button" value="Очистить" id = "clean" class="btn btn-default">
</div>
</body>
<script type="text/javascript">
    var i1 = document.getElementsByName('winner')[0];
    var i2 = document.getElementsByName('second')[0];
    var i3 = document.getElementsByName('loser')[0];
    var clean = document.getElementById('clean');
    var buttons = document.getElementsByClassName('btn-info');
    var clicks = 0;
    var values = [];
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', function () {
            if (clicks == 0) {
                insert(i1, this.value);
            } else if (clicks == 1) {
                insert(i2, this.value);
            } else if (clicks == 2) {
                insert(i3, this.value);
            }
        });
    }

    clean.addEventListener('click', function () {
        clear(i1);
        clear(i2);
        clear(i3);
        clicks = 0;
        values = [];
    });

    function clear(i) {
        i.value = "";
    }

    function insert(i, value) {
        if (!isvalue_inArr(values, value)) {
            i.value = value;
            values.push(value);
            clicks++;
        } else alert('Уже добавлено');
    }

    function isvalue_inArr (arr, el) {
        for(var i = 0; i < arr.length; i++) {
            if (arr[i] == el) return true;
        }
        return false;
    }
</script>
