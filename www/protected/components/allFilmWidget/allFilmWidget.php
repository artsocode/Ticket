<?php
class allFilmWidget extends CWidget {
    private $all_films = null;
    public function init() {
        Yii::import('application.components.allFilmWidget.models.*');
        $this->all_films = allFilmModel::getAllFilms();
    }

    public function run() {
        $this->render("allFilm", array('all_films' => $this->all_films));
    }
}