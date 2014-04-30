<div class="select-schedule-container">
    <div class="control-block-header">
        <h2 class="control-header-text">Выберите сеанс:</h2>
    </div>
    <div class="select-schedule-control">
        <table class="table table-hover" id="schedule-table">
            <thead>
            <tr>
                <td>Время сеанса</td>
                <td>Номер зала</td>
                <td>Цена билета</td>
            </tr>
            </thead>
            <tbody>
            <?php
            for($i = 0, $count = count($schedule_data); $i < $count; $i++) {
                echo '
                    <tr film-id="'.$schedule_data[$i]['film_id'].'" cinema-hall-id="'.$schedule_data[$i]['ch_id'].'" schedule-id="'.$schedule_data[$i]['sc_id'].'">
                        <td>'.date('H:i', $schedule_data[$i]['schedule_date']).'</td>
                        <td>'.$schedule_data[$i]['hall_number'].'</td>
                        <td>200 <i class="fa fa-rub"></i></td>
                    </tr>
                ';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>