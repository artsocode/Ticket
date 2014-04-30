<?php
class MovieController extends Controller {

    public $defaultAction = 'index';

    public function init() {
        //Основной шаблон
        $this->layout = 'main';
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionAbout() {
        if( (isset($_GET['id']) && !empty($_GET['id'])) && intval($_GET['id']) > 0) {
            $film_id = intval($_GET['id']);

            $film_data = aboutFilmModel::getFilmInfoFromId($film_id); //Получаем данные о фильме
            $film_moment = aboutFilmModel::getFilmMomentFromId($film_id); //Получаем данные о фильме

            if($film_data) {
                $this->render('about', array('film_data' => $film_data,
                                             'film_moment' => $film_moment));
            } else {
                $this->render('/main/404');
            }

        } else {
            $this->render('/main/404');
        }
    }

    public function actionBuy() {
        if(isset($_GET['id']) && !empty($_GET['id']) && intval($_GET['id']) > 0) {
            $film_id = $_GET['id'];

            $film_data = aboutFilmModel::getFilmInfoFromId($film_id);

            if($film_data) {
                $cinema = new movieModel();
                $cinema = $cinema->getMovie();

                $this->render('buy', array('cinema' => $cinema,
                                           'film_data' => $film_data));
            } else {
                $this->redirect('/movie');
            }
        } else {
            $this->redirect('/movie');
        }
    }

    public function action404() {
        $this->render('/main/404');
    }

    public function actionGetSchedule() {
        if(isset($_POST['cinema_id']) && !empty($_POST['cinema_id']) && intval($_POST['cinema_id']) > 0) {
            if(isset($_POST['film_id']) && !empty($_POST['film_id']) && intval($_POST['film_id']) > 0) {

                $cinema_id = $_POST['cinema_id'];
                $film_id = $_POST['film_id'];

                $schedule_data = new movieModel();
                $schedule_data = $schedule_data->getScheduleFromId($cinema_id, $film_id);

                if($schedule_data) {
                    $this->renderPartial('select_schedule', array('schedule_data' => $schedule_data));
                } else {
                    echo 'false';
                    return true;
                }
            } else {
                echo 'false';
                return true;
            }
        } else {
            echo 'false';
            return true;
        }
    }

    public function actionGetSeats() {
        if(isset($_POST['film_id']) && !empty($_POST['film_id']) && intval($_POST['film_id']) > 0) {
            if(isset($_POST['schedule_id']) && !empty($_POST['schedule_id']) && intval($_POST['schedule_id']) > 0) {

                $film_id = $_POST['film_id'];
                $schedule_id = $_POST['schedule_id'];

                $seat_data = new movieModel();
                $seat_data = $seat_data->getSeatsFromId($film_id, $schedule_id);

                if($seat_data) {
                    $this->renderPartial('select_seat', array('seat_data' => $seat_data));
                } else {
                    echo 'false';
                    return true;
                }
            } else {
                echo 'false';
                return true;
            }
        } else {
            echo 'false';
            return true;
        }
    }

    public function actionError() {
        if($error=Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }
}