<?php
class TicketController extends Controller {

    public $defaultAction = 'index';

    public function init() {
        //Основной шаблон
        $this->layout = 'main';
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionBuy() {
        //Если информация о платеже есть в куках.
        if( Yii::app()->request->cookies['hash'] ) {

            $hash = Yii::app()->request->cookies['hash']->value;

            $buy_ticket_hash = new ticketModel();
            $buy_ticket_hash = $buy_ticket_hash->getTicketInfoFromHash($hash);
            $hash = count($buy_ticket_hash) > 1 ? $buy_ticket_hash[0]['hash'] : $buy_ticket_hash['hash'];

            $this->render('buy', array('hash' => $hash));

        } elseif( isset($_GET["fi_id"]) &&
                  isset($_GET["ci_id"]) &&
                  isset($_GET["ch_id"]) &&
                  isset($_GET["sc_id"]) &&
                  isset($_GET["seat_id"])  ) {

                  $buy_ticket_hash = new ticketModel();
                  $buy_ticket_hash = $buy_ticket_hash->purchaseTheTicket($_GET["fi_id"],
                                                                         $_GET["ci_id"],
                                                                         $_GET["ch_id"],
                                                                         $_GET["sc_id"],
                                                                         $_GET["seat_id"]);

                  if( $buy_ticket_hash ) {

                      $cookie = new CHttpCookie('hash', $buy_ticket_hash['hash']);
                      $cookie->expire = time()+300; //5 минут
                      Yii::app()->request->cookies['hash'] = $cookie;

                      $this->render('buy', array('hash' => $buy_ticket_hash['hash']));
                  } else {
                      $this->render('/main/404');
                  }
        } else {
            $this->render('/main/404');
        }
    }

    public function actionEndTicketPayment() {
        if( (isset($_POST['name']) && !empty($_POST['name'])) &&
            (isset($_POST['email']) && !empty($_POST['email'])) &&
            (isset($_POST['phone']) && !empty($_POST['phone'])) &&
            (isset($_POST['hash']) && !empty($_POST['hash'])) ) {

            $end_ticket_payment_result = new ticketModel();
            $end_ticket_payment_result = $end_ticket_payment_result->endPayment($_POST['name'],
                                                                                $_POST['email'],
                                                                                $_POST['phone'],
                                                                                $_POST['hash']);
            unset(Yii::app()->request->cookies['hash']);

            if( $end_ticket_payment_result ) {
                $this->render('pay_result', array('message' => 'Платёж прошёл успешно! Благодарим за покупку!
                                                                Билет успешно приобретён. Предьявите номер указанный
                                                                ниже на кассе выбранного кинотеатра вместе
                                                                с номером телефона, указанным при оформлении.
                                                                <br/><b>Вся информация выслана вам на Email</b>',
                                                  'status' => 'success',
                                                  'control_number' => $end_ticket_payment_result['ticket_control_number']));
            } else {
                $this->render('pay_result', array('message' => 'Платёж не прошёл! К сожалению что-то пошло не так.
                                                                Попробуйте заказать билет через 5-6 минут.',
                                                  'status' => 'error'));
            }

        } else {
            $this->render('/main/404');
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