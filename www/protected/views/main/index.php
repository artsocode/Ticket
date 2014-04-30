<div class="new-film-gallery-block">
    <h1 class="page-header-text">Новинки:</h1>
    <?php $this->widget("application.components.newFilmWidget.newFilmWidget");?>
</div>

<div class="popular-films-gallery">
    <h1 class="page-header-text">Фильмы:</h1>
    <div class="popular-films-container">
        <?php $this->widget("application.components.allFilmWidget.allFilmWidget");?>
        <?php $this->widget("application.components.allFilmWidget.allFilmWidget");?>
        <?php $this->widget("application.components.allFilmWidget.allFilmWidget");?>
        <?php $this->widget("application.components.allFilmWidget.allFilmWidget");?>
    </div>
</div>