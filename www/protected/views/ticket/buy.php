<!-- Основные настройки шаблона -->
<link rel="stylesheet" href="../../../assets/main/css/ticket/finishBuyLayout.css" />

<div class="finish-ticket-buy-container">
    <h1 class="page-header-text">Завершение покупки:</h1>
    <div class="finish-body">
        <form class="finish-ticket-buy-form" action="/ticket/endTicketPayment" method="POST">
            <input class="finish-input" type="text" name="name" placeholder="Ваше имя" required/>
            <input class="finish-input" type="email" name="email" placeholder="Ваш email" required/>
            <input class="finish-input" id="phoneField" type="text" name="phone" placeholder="Ваш телефон" required/>
            <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
            <button class="submit-form-btn" type="submit"><i class="fa fa-credit-card"></i> Оплатить</button>
        </form>
    </div>
</div>

<!-- Маска для поля телефона -->
<script src="../../../assets/main/js/plugins/MaskedInput/jquery.maskedinput.min.js"></script>

<!-- Инициализация плагинов -->
<script src="../../../assets/main/js/ticket/plaginInit.js"></script>