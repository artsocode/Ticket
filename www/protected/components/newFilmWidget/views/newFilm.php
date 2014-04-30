<?php
if(isset($new_films) && !is_null($new_films)) {
    echo '
    <div class="fotorama"
     data-width="100%"
     data-height="420px"
     data-loop="true">
    ';

    for($i = 0, $count = count($new_films); $i < $count; $i++) {
        echo '
        <div class="new-film-item" data-img="../../../assets/main/images/horisontal_poster/' . $new_films[$i]['h_poster'] . '">
            <a href="/movie/buy?id=' . $new_films[$i]['id'] . '" title="Купить билет" target="_self" rel="Внутренняя страница покупки билета" rev="Купить билет">
                <div class="buy-are-ticket-btn">
                    <span class="but-ticket-text"><i class="fa fa-ticket"></i> Купить билет</span>
                </div>
            </a>
            <div class="black-background"></div>
        </div>
        ';
    }

    echo '
    </div>
    ';
}