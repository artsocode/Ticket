$(document).ready(function(e) {
    "use strict";

    /*Получаем расписание на конкретный фильм для кинотеатра выбранного в селекте*/
    var payment_btn;
    var select_cinema = $("#select-cinema");

    select_cinema.on("change", function(e) {
        var cinema_id = $(this.options[this.selectedIndex]).val(),
            film_id = $(this.options[this.selectedIndex]).attr('data-film-id');
        NProgress.start();
        getSchedule(cinema_id, film_id);
    });

    /*Функция которая получает расписание из представления*/

    function getSchedule(cinema_id, film_id) {
        hideScheduleSeatsAndBuy();
        try {
            $.ajax({
                url: '/movie/getSchedule',
                type: 'POST',
                cache: false,
                data: {
                    'cinema_id': cinema_id,
                    'film_id': film_id
                },
                success: function(answer) {
                    if (answer === "false") {
                        noty({
                            layout: 'topRight',
                            type: 'error',
                            text: 'Сеансы не найдены, обновите страницу и попробуйте снова!'
                        });
                        NProgress.done();
                        return false;
                    }
                    pastTableInToDom(answer);
                    NProgress.done();
                    return true;
                }
            });
        } catch (error) {
            noty({
                layout: 'topRight',
                type: 'error',
                text: 'Сеансы не найдены, обновите страницу и попробуйте снова!'
            });
            NProgress.done();
            return false;
        }
    }

    function hideScheduleSeatsAndBuy() {
        $(".payment-container").hide();
        $('#seat-container').html("");
        $('#schedule-table').html("");
    }

    /*Вставляем HTML в DOM*/

    function pastTableInToDom(tableHtml) {
        var container = $('#schedule-table').html("");
        container.append(tableHtml);

        addEventListenerToTable();
        return true;
    }

    /*Слушатель событий для таблицы расписания*/

    function addEventListenerToTable() {
        var tr_table = $("#schedule-table>tbody>tr");
        tr_table.on("click", function(e) {
            var schedule_id, film_id;

            tr_table.each(function() {
                $(this).removeClass("blue");
            });

            $(this).addClass("blue");
            schedule_id = $(this).attr("schedule-id"),
            film_id = $(this).attr("film-id");

            NProgress.start();
            getSeats(schedule_id, film_id);
        });
    }

    /*Функция которая получает места из представления*/

    function getSeats(schedule_id, film_id) {
        try {
            $.ajax({
                url: '/movie/getSeats',
                type: 'POST',
                cache: false,
                data: {
                    'schedule_id': schedule_id,
                    'film_id': film_id
                },
                success: function(answer) {
                    if (answer === "false") {
                        noty({
                            layout: 'topRight',
                            type: 'error',
                            text: 'Места для данного сеанса не найдены, обновите страницу и попробуйте снова!'
                        });
                        NProgress.done();
                        return false;
                    }
                    pastSeatInToTheDom(answer);
                    NProgress.done();
                    return true;
                }
            });
        } catch (error) {
            noty({
                layout: 'topRight',
                type: 'error',
                text: 'Места для данного сеанса не найдены, обновите страницу и попробуйте снова!'
            });
            NProgress.done();
            return false;
        }
    }

    /*Добавляет места*/

    function pastSeatInToTheDom(html) {
        var container = $('#seat-container').html("").append(html);

        addEventListenerToSeatTable();
        return true;
    }

    /*Обработчик чекбоксов мест*/

    function addEventListenerToSeatTable() {
        $('.seat-table>tbody>tr>td>input:checkbox').on('click', function(e) {
            var checked_checkbox_count = $('.seat-table>tbody>tr>td>input[type=checkbox]:checked:not(:disabled)').length,
                checkbox_sum = ($('.seat-table>tbody>tr>td>input[type=checkbox]:checked:not(:disabled)').length * 250);

            buyTicketShowInfo(checked_checkbox_count);

            if (checked_checkbox_count === 0) {
                $(".payment-container").css({
                    'display': 'none'
                });
            } else {
                $(".payment-container").css({
                    'display': 'block'
                });
            }

            $("#sum-container").text(checkbox_sum);
        });
    }

    /*Отображение информации о покупке*/

    function buyTicketShowInfo(t_count) {
        $("#ticket-count").html(t_count);
        $('#ticket-info').html("");

        $('.seat-table>tbody>tr>td>input[type=checkbox]:checked:not(:disabled)').each(function() {
            $('#ticket-info').append("<br/>Ряд: <b>" + $(this).attr('data-row') + "</b>. Место: <b>" + $(this).attr('data-place') + "</b><b class=\"blue-text\"> - 250 р.</b>");
        });
    }

    /*Формирование ссылки на покупку билета и переход к оплате*/
    payment_btn = $("#payment-btn");
    payment_btn.on("click", function(e) {
        //id фильма
        //id кинотеатра
        //id зала
        //id сеанса
        //id места

        var seat_id = '',
            last_checkbox, row_and_place, fi_id, ci_id, сh_id, sc_id, get_url;

        last_checkbox = $('.seat-table>tbody>tr>td>input[type=checkbox]:checked:not(:disabled)').length - 1;
        $('.seat-table>tbody>tr>td>input[type=checkbox]:checked:not(:disabled)').each(function(e, i) {
            if (e === last_checkbox) {
                seat_id += $(this).attr('data-seat-id');
            } else {
                seat_id += $(this).attr('data-seat-id') + ",";
            }
        });

        fi_id = $("#schedule-table>tbody>tr.blue").attr('film-id'),
        ci_id = $("#select-cinema option:selected").val(), сh_id = $("#schedule-table>tbody>tr.blue").attr('cinema-hall-id'),
        sc_id = $("#schedule-table>tbody>tr").attr('schedule-id'),
        get_url = "/ticket/buy?fi_id=" + fi_id + "&ci_id=" + ci_id + "&ch_id=" + сh_id + "&sc_id=" + sc_id + "&seat_id=" + seat_id;

        window.location.href = get_url;
    });

});
