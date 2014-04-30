<!-- Основные настройки шаблона -->
<link rel="stylesheet" href="../../../assets/main/css/movie/buyLayout.css" />

<div class="buy-ticket-container">
    <h1 class="page-header-text">Покупка билета на фильм:</h1>
    <div class="buy-ticket-body">
        <div class="buy-ticket-film">
            <div class="ticket-film-name">
                <a href="/movie/about?id=<?php echo $film_data['id']?>"  title="<?php echo $film_data['name']?>" target="_self" rel="Внутренняя страница о фильме" rev="О фильме">
                    <h2 class="film-name" id="film_name"><?php echo $film_data['name']?></h2>
                </a>
            </div>
            <div class="ticket-film-poster">
                <img src="../../../assets/main/images/vertical_poster/<?php echo $film_data['v_poster']?>" alt="<?php echo $film_data['name']?>"/>
            </div>
        </div>

        <div class="buy-controls-container">
            <div class="select-cinema-container">
                <div class="control-block-header">
                    <h2 class="control-header-text">Выберите кинотеатр:</h2>
                </div>
                <div class="select-cinema-control">
                    <select class="select-cinema" id="select-cinema" name="cinemas">
                        <option selected disabled value="0">Кинотеатры</option>
                        <?php
                            for($i = 0, $count = count($cinema); $i < $count; $i++) {
                               echo '<option data-film-id="'.$film_data['id'].'" value="'.$cinema[$i]['c_id'].'">'.$cinema[$i]['c_name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div id="schedule-table"></div>
        </div>
    </div>

    <div id="seat-container"></div>

    <div class="payment-container">
        <div class="payment-block-header">
            <h2 class="control-header-text">Оплата:</h2>
        </div>
        <div class="payment-subject-container">
            <p class="payment-subject">
                <span id="ticket-count">0</span><span id="ticket-text"> x Билет на фильм: </span><b class="blue-text">«<?php echo $film_data['name'];?>»</b>
                <p id="ticket-info"></p>
            </p>
        </div>
        <div class="sum-container">
            <h2 class="sum-text control-header-text">Итого: <b class="blue-text-sum" id="sum-container">0 </b><i class="fa fa-rub blue-text-sum"></i></h2>
        </div>
        <div class="payment-btn" id="payment-btn"><i class="fa fa-credit-card"></i> Оплата и получение</div>
    </div>
</div>