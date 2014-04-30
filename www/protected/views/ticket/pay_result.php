<!-- Основные настройки шаблона -->
<link rel="stylesheet" href="../../../assets/main/css/ticket/endPayment.css" />

<div class="end-payment">
    <h1 class="page-header-text">Покупка завершена:</h1>

    <?php
    if( $status == 'success' ) {
        echo '
            <div class="message-box message-success">
                '.$message.'
            </div>
            <div class="control-number">
                <h1 class="text-success">';
                    echo join('-', str_split($control_number, 3));
        echo '  </h1>
            </div>
        ';
    } else {
        echo '
            <div class="message-box message-error">
                '.$message.'
            </div>
        ';
    }

    ?>

</div>