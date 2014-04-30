<?php
/**
 * Class allFilmModel
 *
 * Класс который возвращает все фильмы на главную страницу
 */
class allFilmModel {

    /**
     * Функция которая достаёт все, горизонтальные картинки из базы.
     * @return bool || array
     */
    public static function getAllFilms() {
        try {
            $sql_query = "SELECT id, film_name, film_vertical_poster AS v_poster FROM film";
            $sql_result = Yii::app()->db->createCommand($sql_query)->queryAll();

            if($sql_result) {
                return $sql_result;
            } else {
                return false;
            }
        } catch(Exception $e) {
            return false;
        }
    }
}