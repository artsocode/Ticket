<?php
class newFilmWidget extends CWidget {
    private $new_films = null;
    public function init() {
        Yii::import('application.components.newFilmWidget.models.*');
        $this->new_films = newFilmModel::getNewFilms();
    }

    public function run() {
        $this->render("newFilm", array('new_films' => $this->new_films));
    }
}