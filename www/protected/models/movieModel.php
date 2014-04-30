<?php
/**
 * Class movieModel
 * Класс который позволяет получать данные о кинотеатрах, залах, фильмах.
 */
class movieModel {

    private $cinema_list = null; //Список кинотеатров

    public function __construct() {
        $this->cinema_list = $this->getMovieFromDb();
    }

    /**
     * @return bool || array || null
     */
    public function getMovie() {
        return $this->cinema_list;
    }

    /**
     * @return bool || array
     * Получаем данные о кинотеатрах из базы.
     */
    private function getMovieFromDb() {
        try {
            $sql_query = "SELECT id AS c_id,
                                 cinema_name AS c_name
                            FROM cinema";

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

    /**
     * @param $cinema_id
     * @param $film_id
     * @return bool || array
     * Возвращает расписание из базы
     */
    public function getScheduleFromId($cinema_id, $film_id) {
        try {
            $sql_query = "SELECT ch.id AS ch_id,
                                 ch.cinema_id,
                                 ch.hall_number,
                                 sc.id AS sc_id,
                                 sc.schedule_date,
                                 sc.film_id

                            FROM cinema_hall ch

                            JOIN schedule sc
                              ON ch.id = sc.cinema_hall_id

                           WHERE ch.cinema_id = :cinema_id
                             AND sc.film_id = :film_id;";

            $sql_param = array(':cinema_id' => $cinema_id,
                               ':film_id' => $film_id);

            $sql_result = Yii::app()->db->createCommand($sql_query)->queryAll(true, $sql_param);

            if($sql_result) {
                return $sql_result;
            } else {
                return false;
            }
        } catch(Exception $e) {
            return $e;
        }
    }

    /**
     * @param $film_id
     * @param $schedule_id
     * @return bool || array
     * Возвращает места из базы
     */
    public function getSeatsFromId($film_id, $schedule_id) {
        try {
            $sql_query = "SELECT se.id,
                                 se.row,
                                 se.place,
                                 ti.is_active

                            FROM seat se

                       LEFT JOIN ticket ti
                              ON ti.seat_id = se.id

                            JOIN schedule sc
                              ON sc.id = :schedule_id

                           WHERE se.cinema_hall_id = sc.cinema_hall_id
                             AND sc.film_id = :film_id";

            $sql_param = array(':film_id' => $film_id,
                               ':schedule_id' => $schedule_id);

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