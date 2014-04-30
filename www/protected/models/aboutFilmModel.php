<?php
/**
 * Class aboutFilmModel
 * Класс который вытаскивает из базы информацию о фильме и его моментах.
 */
class aboutFilmModel {

    /**
     * Функция которая вытаскивает из базы информацию о фильме.
     * @param $film_id
     * @return bool || array
     */
    public static function getFilmInfoFromId($film_id) {
        try {
            $sql_query = "SELECT id,
                                 film_name AS name,
                                 film_description AS description,
                                 film_vertical_poster AS v_poster,
                                 film_rating AS rating

                            FROM film

                           WHERE id = :film_id";
            $sql_param = array(':film_id' => $film_id);
            $sql_result = Yii::app()->db->createCommand($sql_query)->queryRow(true, $sql_param);

            if($sql_result) {
                return $sql_result;
            } else {
                return false;
            }
        } catch(Exception $e) {
            return false;
        }
    }

    /**
     * Функция которая вытаскивает из базы моменты из фильма.
     * @param $film_id
     * @return bool || array
     */
    public static function getFilmMomentFromId($film_id) {
        try {
            $sql_query = "SELECT id,
                                 moment_image AS fm_image

                            FROM film_moment

                           WHERE film_id = :film_id";
            $sql_param = array(':film_id' => $film_id);
            $sql_result = Yii::app()->db->createCommand($sql_query)->queryAll(true, $sql_param);

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