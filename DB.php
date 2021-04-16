<?php


class DB
{
    private $connection;

    public function __construct() {
        $this->connection = mysqli_connect('durak', 'root', 'root', 'durak');
    }

    public function getPlayers($id = null) {
        if ($id != null) $sql = "select *from players where id = '$id'";
        else $sql = "select *from players";
        $result = mysqli_query($this->connection, $sql);

        $players = [];

        while ($row = mysqli_fetch_assoc($result)) {
            array_push($players, $row);
        }
        return $this->sort($players);

    }

    public function getId() {
        $sql = "select max(id) from players";
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_assoc($result)['max(id)'];
    }

    public function update ($players) {
        $this->insert_games($players);
        $this->win($players['winner']);
        $this->draw($players['second']);
        $this->lose($players['loser']);
        $this->scores($players['winner'], $players['second']);
    }

    private function insert_games ($players) {
        foreach ($players as $player) {
            $sql = "update players set games = games + 1 where name = '$player'";
            mysqli_query($this->connection, $sql);
        }
    }

    private function win ($player) {
        $sql = "update players set winers = winers + 1 where name = '$player'";
        mysqli_query($this->connection, $sql);
    }

    private function draw ($player) {
        $sql = "update players set draws = draws + 1 where name = '$player'";
        mysqli_query($this->connection, $sql);
    }

    private function lose($player) {
        $sql = "update players set loses = loses + 1 where name = '$player'";
        mysqli_query($this->connection, $sql);
    }

    private function scores ($winner, $second) {
        $slq1 = "update players set scores = scores + 3 where name = '$winner'";
        $slq2 = "update players set scores = scores + 1 where name = '$second'";
        mysqli_query($this->connection, $slq1);
        mysqli_query($this->connection, $slq2);
    }

    private function sort ($arr) {
        for ($i = 0; $i < count($arr); $i++) {
            for ($j = 0; $j < count($arr)-1; $j++) {
                if ($arr[$j+1]['scores'] > $arr[$j]['scores']) {
                    $el = $arr[$j+1];
                    $arr[$j+1] = $arr[$j];
                    $arr[$j] = $el;
                }
            }
        }
        return $arr;
    }

    public function updatePlayer($id, $name) {
        $sql = "update players set name = '$name' where id = '$id'";
        mysqli_query($this->connection, $sql);
    }

    public function createPlayer($name) {
        $sql = "insert into players (name) values('$name')";
        mysqli_query($this->connection, $sql);
    }

    public function deletePlayer($id) {
        $player = $this->getPlayers($id)[0];
        $id = $player['id']; $name = $player['name']; $games = $player['games'];$scores = $player['scores'];
        $winers = $player['winers']; $draws = $player['draws']; $loses = $player['loses'];
        $sql = "delete from players where id = '$id'";
        $insert  = "insert into reservs     
            (id, name, games, winers, draws, loses, scores)
            values ('$id', '$name', '$games', '$winers', '$draws', '$loses', '$scores')";

        mysqli_query($this->connection, $sql);
        mysqli_query($this->connection, $insert);
    }

    public function clear() {
        $sql = "UPDATE players set games = 0, winers = 0, draws = 0, loses = 0, scores = 0;";
        mysqli_query($this->connection, $sql);
    }

    public function addImage($id, $image) {
        $sql = "update players set image = '$image' where id = '$id'";
        mysqli_query($this->connection, $sql);
    }

    public function getImage($id) {
        $sql = "select image from players where id = '$id'";
        return mysqli_fetch_assoc(mysqli_query($this->connection, $sql))['image'];
    }
}