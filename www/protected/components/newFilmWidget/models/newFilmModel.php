<?php
/**
 * Class newFilmModel
 *
 * Класс который возвращает новые постеры в центральную галерею
 */
class newFilmModel {

    /**
     * Функция которая достаёт новые, горизонтальные картинки из базы.
     * @return bool || array
     */
    public static function getNewFilms() {
        try {
            $sql_query = "SELECT id, film_horizontal_poster AS h_poster FROM film";
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