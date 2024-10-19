<?php
include_once 'models/cave.php';

class CaveController {
    public $model;

    public function __construct() {
        $this->model = new Cave();
    }

    public function invoke() {
        if (!isset($_GET['page'])) {
            $caves = $this->model->getCaveList();
            include 'views/caveList.php';
        } else {
            $cave = $this->model->getCave($_GET['page']);
            include 'views/viewCave.php';
        }
    }
}

