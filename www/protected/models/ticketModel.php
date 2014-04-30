<?
/**
 * Class ticketModel
 * Класс которы позволяет дооформить покупку билета. И проверяет данные для покупки билета.
 */
class ticketModel {

    /**
     * @param $fi_id
     * @param $ci_id
     * @param $ch_id
     * @param $sc_id
     * @param $seat_id
     * @return bool | array
     */
    public function purchaseTheTicket($fi_id, $ci_id, $ch_id, $sc_id, $seat_id) {

        $new_data = $this->checkPurchaseTheTicket($fi_id, $ci_id, $ch_id, $sc_id, $seat_id);
        if( $new_data ) {
            $transaction = Yii::app()->db->beginTransaction();

            try {
                $sql_result = null;
                $cur_date = time(); //Временная метка.
                $control_numb = rand(111111111, 999999999); //Контрольные цыфры билета
                $hash = md5($fi_id . $ci_id . $ch_id . $sc_id . $seat_id . $cur_date);

                $sql_query = "INSERT INTO ticket(cinema_hall_id,
                                                 order_date,
                                                 schedule_id,
                                                 ticket_control_number,
                                                 ticket_hash_sum,
                                                 seat_id)

                                   VALUES (:ch_id,
                                           :cur_time,
                                           :sc_id,
                                           :control_numb,
                                           :hash,
                                           :seat_id)";

                if( is_array($new_data['seat_id']) ) {
                    for($i = 0, $count = count($new_data['seat_id']); $i < $count; $i++) {

                        $sql_param = array(':ch_id' => $new_data['сh_id'],
                                           ':cur_time' => $cur_date,
                                           ':sc_id' => $new_data['sc_id'],
                                           ':control_numb' => $control_numb,
                                           ':hash' => $hash,
                                           ':seat_id' => $new_data['seat_id'][$i]);
                        $sql_result = Yii::app()->db->createCommand($sql_query)->execute($sql_param);
                    }
                } else {
                    $sql_param = array(':ch_id' => $new_data['сh_id'],
                                       ':cur_time' => $cur_date,
                                       ':sc_id' => $new_data['sc_id'],
                                       ':control_numb' => $control_numb,
                                       ':hash' => $hash,
                                       ':seat_id' => $new_data['seat_id']);
                    $sql_result = Yii::app()->db->createCommand($sql_query)->execute($sql_param);
                }

                $returned_data = array('hash' => $hash, 'control_number' => $control_numb);

                if($sql_result) {
                    $transaction->commit();
                    return $returned_data;
                } else {
                    $transaction->rollback();
                    return false;
                }
            } catch(CDbException $e) {
                $transaction->rollback();
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param $fi_id
     * @param $ci_id
     * @param $сh_id
     * @param $sc_id
     * @param $seat_id
     * @return array|bool
     *
     * Проверяет полученные GET-ом данные от пользователя.
     */
    private function checkPurchaseTheTicket($fi_id, $ci_id, $сh_id, $sc_id, $seat_id) {

        if( $this->issetNotEmptyNotZero($fi_id) &&
            $this->issetNotEmptyNotZero($ci_id) &&
            $this->issetNotEmptyNotZero($сh_id) &&
            $this->issetNotEmptyNotZero($sc_id) ) {

            $seat_explode_flag = strripos($seat_id, ",");

            if( $seat_explode_flag !== false ) {
                $seat_id = explode(",", $seat_id);

                return array("fi_id" => $fi_id,
                             "ci_id" => $ci_id,
                             "сh_id" => $сh_id,
                             "sc_id" => $sc_id,
                             "seat_id" => $seat_id);

            } else {
                if( $this->issetNotEmptyNotZero($seat_id) ) {
                    return array("fi_id" => $fi_id,
                                 "ci_id" => $ci_id,
                                 "сh_id" => $сh_id,
                                 "sc_id" => $sc_id,
                                 "seat_id" => $seat_id);
                } else {
                    return false;
                }
            }

        } else {
            return false;
        }
    }

    /**
     * @param $value
     * @return bool
     * Группировка проверки
     */
    private function issetNotEmptyNotZero($value) {
        if( isset($value) && !empty($value) && intval($value) > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $hash
     * @return bool | array
     * Возвращает информацию о билете по хэшу из кук
     */
    public function getTicketInfoFromHash($hash) {
        try {
            $sql_query = "SELECT ticket_control_number AS control_number,
                                 ticket_hash_sum AS hash
                            FROM ticket
                           WHERE ticket_hash_sum = :hash
                             AND is_active = 0";

            $sql_param = array(':hash' => $hash);

            $sql_result = Yii::app()->db->createCommand($sql_query)->queryAll(true, $sql_param);

            if( $sql_result ) {
                return $sql_result;
            } else {
                return false;
            }
        } catch(CDbException $e) {
            return $e;
        }
    }

    /**
     * @param $name
     * @param $email
     * @param $phone
     * @param $hash
     * @return bool | array
     */
    public function endPayment($name, $email, $phone, $hash) {
        try {
            $sql_query = "UPDATE ticket SET buyer_name = :name,
                                            buyer_email = :email,
                                            buyer_phone = :phone,
                                            is_active = 1
                                      WHERE ticket_hash_sum = :hash
                                        AND is_active = 0";

            $sql_param = array(':name' => $name,
                               ':email' => $email,
                               ':phone' => $phone,
                               ':hash' => $hash);

            $sql_result = Yii::app()->db->createCommand($sql_query)->execute($sql_param);

            if( $sql_result ) {
                $control_number = $this->getControlNumberFromDb($hash);
                $sending_result = $this->sendPaymentEmailData($hash, $email);

                if( $control_number && $sending_result ) {
                    return $control_number;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch(CDbException $e) {
            return $e;
        }
    }

    /**
     * @param $hash
     * @return bool | array
     * Возвращает контрольные цыфры покупки
     */
    private function getControlNumberFromDb($hash) {
        try {
            $sql_query = "SELECT ticket_control_number FROM ticket WHERE ticket_hash_sum = :hash AND is_active = 1";

            $sql_param = array(':hash' => $hash);

            $sql_result = Yii::app()->db->createCommand($sql_query)->queryRow(true, $sql_param);

            if( $sql_result ) {
                return $sql_result;
            } else {
                return false;
            }
        } catch(CDbException $e) {
            return false;
        }
    }

    /**
     * @param $hash
     * @param $email
     * @return bool
     * Отправляет данные о покупке билета клиенту на email
     */
    private function sendPaymentEmailData($hash, $email) {
        $ticketData = $this->getAllTicketInfoFromDb($hash);
        if( !$ticketData ) {
            return false;
        }

        $message = "
        <h1>Благодарим Вас за покупку белета на сайте: ".Yii::app()->name."</h1><br/>
        <div>
            <h3>Ваши данные:</h3>

            <span>Имя: <b>".$ticketData['buyer_name']."</b></span><br/>
            <span>Email: <b>".$ticketData['buyer_email']."</b></span><br/>
            <span>Телефон: <b>".$ticketData['buyer_phone']."</b></span><br/>

            <br/><br/><h3>Данные о сеансе:</h3>

            <span>Кинотеатр: <b>".$ticketData['cinema_name']."</b></span><br/>
            <span>Адрес: <b>".$ticketData['cinema_address']."</b></span><br/>
            <span>Фильм: <b>".$ticketData['film_name']."</b></span><br/>
            <span>Сеанс: <b>".date("d.m.Y. G:i", $ticketData['schedule_date'])."</b></span><br/>
            <span>Зал: <b>".$ticketData['hall_number']."</b></span><br/>
            <span>Ряд: <b>".$ticketData['row']."</b></span><br/>
            <span>Место: <b>".$ticketData['place']."</b></span><br/>
            <span>Дата покупки билета: <b>".date('d.m.Y G:i', $ticketData['order_date'])."</b></span><br/>
            <span>Контрольный номер: <b>".join("-", str_split($ticketData['ticket_control_number'], 3))."</b></span><br/>

        </div>
        ";

        $send_result = new emailModel();
        $send_result = $send_result->sendEmail($email, $message);

        if( $send_result ) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param $hash
     * @return bool | array
     * Возвращает все данные о билете, кинотеатре фильме сеансе.
     */
    private function getAllTicketInfoFromDb($hash) {
        try {
            $sql_query = "SELECT ti.buyer_email,
                                 ti.buyer_name,
                                 ti.buyer_phone,
                                 ti.order_date,
                                 ti.ticket_control_number,
                                 ci.cinema_name,
                                 ci.cinema_address,
                                 ch.hall_number,
                                 sc.schedule_date,
                                 fi.film_name,
                                 se.row,
                                 se.place

                            FROM ticket ti

                            JOIN cinema_hall ch
                              ON ch.id = ti.cinema_hall_id

                            JOIN cinema ci
                              ON ci.id = ch.cinema_id

                            JOIN schedule sc
                              ON sc.id = ti.schedule_id

                            JOIN film fi
                              ON fi.id = sc.film_id

                            JOIN seat se
                              ON se.id = ti.seat_id

                           WHERE ti.ticket_hash_sum = :hash
                             AND ti.is_active = 1";

            $sql_param = array(':hash' => $hash);

            $sql_result = Yii::app()->db->createCommand($sql_query)->queryRow(true, $sql_param);

            if( $sql_result ) {
                return $sql_result;
            } else {
                return false;
            }
        } catch(CDbException $e) {
            return false;
        }
    }
}