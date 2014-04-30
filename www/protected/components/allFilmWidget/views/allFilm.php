<?php
if(isset($all_films) && !is_null($all_films)) {

    for($i = 0, $count = count($all_films); $i < $count; $i++) {
        echo '
        <div class="popular-film-item" title="'.$all_films[$i]['film_name'].'">
            <div class="film-image-container">
                <img src="../../../assets/main/images/vertical_poster/'.$all_films[$i]['v_poster'].'" alt="'.$all_films[$i]['film_name'].'"/>
            </div>
            <div class="popular-film-controls">
                <a href="/movie/buy?id=' . $all_films[$i]['id'] . '" title="Купить билет" target="_self" rel="Внутренняя страница покупки билета" rev="Купить билет">
                    <div class="popular-film-buy-ticket">
                        <i class="fa fa-ticket"></i> Купить билет
                    </div>
                </a>
                <a href="/movie/about?id=' . $all_films[$i]['id'] . '" title="О фильме" target="_self" rel="Внутренняя страница, описание фильма" rev="О фильме">
                    <div class="popular-film-about-film">
                        <i class="fa fa-film"></i> О фильме
                    </div>
                </a>
            </div>
            <div class="film-name-container">
                <p class="film-name-text">'.$all_films[$i]['film_name'].'</p>
            </div>
            <div class="popular-film-black-background"></div>
        </div>
        ';
    }

}