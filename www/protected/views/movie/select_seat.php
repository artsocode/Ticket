<div class="select-seat-container">
    <div class="seat-block-header">
        <h2 class="control-header-text">Выберите место:</h2>
    </div>
    <div class="cinema-plane-container">
        <div class="display-container">
            <p class="display-text">Экран</p>
        </div>
        <div class="plane-seat-map">
            <table class="table table-hover seat-table">
                <tbody>
                <?php
                    $save_pos = 0;
                    for($i = 0, $r_count = $seat_data[count($seat_data)-1]['row']; $i < $r_count; $i++) {
                        echo '<tr>';
                            echo '<td>'.($i+1).'</td>';
                                for($j = 0, $s_count = count($seat_data); $j < $s_count; $j++) {
                                    if($j !== 0) {
                                        if($seat_data[$j]['row'] === $seat_data[$j-1]['row']) {
                                            $checked_of_not = !is_null($seat_data[$save_pos]['is_active']) ? 'checked disabled' : '';

                                            echo '<td><input type="checkbox" ' . $checked_of_not . ' data-seat-id="'.$seat_data[$save_pos]['id'].'" data-row="'.$seat_data[$save_pos]['row'].'" data-place="'.$seat_data[$save_pos]['place'].'" title="Ряд - '.$seat_data[$save_pos]['row'].', Место - '.$seat_data[$save_pos]['place'].'"/></td>';
                                            $save_pos++;
                                        } else {
                                            break;
                                        }
                                    } else {
                                        $checked_of_not = !is_null($seat_data[$save_pos]['is_active']) ? 'checked disabled' : '';

                                        echo '<td><input type="checkbox" ' . $checked_of_not . ' data-seat-id="'.$seat_data[$save_pos]['id'].'" data-row="'.$seat_data[$save_pos]['row'].'" data-place="'.$seat_data[$save_pos]['place'].'" title="Ряд - '.$seat_data[$save_pos]['row'].', Место - '.$seat_data[$save_pos]['place'].'"/></td>';
                                        $save_pos++;
                                    }
                                }
                            echo '<td>'.($i+1).'</td>';
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
            <div class="designation-block">
                <div class="sign-block"><input type="checkbox"/> - Свободно</div>
                <div class="sign-block"><input type="checkbox" checked disabled/> - Занято</div>
            </div>
        </div>
    </div>
</div>