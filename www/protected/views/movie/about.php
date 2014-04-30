<?php
echo '
<!-- Основные настройки шаблона -->
<link rel="stylesheet" href="../../../assets/main/css/movie/movieLayout.css" />

<div class="about-film-container">
    <h1 class="page-header-text">Описание фильма:</h1>

    <div class="about-film-description-container">
        <div class="about-film-poster-container">
            <img src="../../../assets/main/images/vertical_poster/'.$film_data['v_poster'].'" alt="'.$film_data['name'].'"/>
        </div>
        <div class="about-film-text-container">
            <div class="about-film-name"><h4 class="about-film-name-text" title="'.$film_data['name'].'">'.$film_data['name'].'</h4></div>
            <div class="about-film-rating"><span class="about-film-rating-text">Рейтинг: </span>'.$film_data['rating'].'/10</div>
            <div class="about-film-description">
                '.$film_data['description'].'
            </div>
            <div class="about-film-buy-ticket">
                <a href="/movie/buy?id='.$film_data['id'].'" title="Купить билет" target="_self" rel="Внутренняя страница покупки билета" rev="Купить билет">
                    <div class="buy-ticket-container"><i class="fa fa-ticket"></i> Купить билет</div>
                </a>
            </div>
        </div>
    </div>

    <h1 class="page-header-text">Кадры из фильма:</h1>
    <div class="fotorama about-film-fotorama"
         data-width="100%"
         data-height="420px"
         data-loop="true">';
for($i = 0, $count = count($film_moment); $i < $count; $i++) {
    echo '<img src="../../../assets/main/images/film_moment/'.$film_moment[$i]['fm_image'].'"/>';
}

echo '
    </div>
</div>
';