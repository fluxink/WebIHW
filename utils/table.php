<?php

function drawTable($data, $data_type) {
    echo '<table class="border">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>
            <label class="checkbox">
                <input type="checkbox" onclick="toggleSelect(this)">
                <div class="tooltip right">Вибрати все</div>
                <span></span>
            </label>
          </th>';
    foreach (array_keys($data[0]) as $key) {
        echo '<th>' . $key . '</th>';
    }
    if ($data_type != 'users') {
        echo '<th class="center-align">Дії</th>';
    }
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>
                <label class="checkbox">
                    <input type="checkbox" name="select" value="' . $row['id'] . '">
                    <span></span>
                </label>
              </td>';
        foreach ($row as $key => $value) {
            if ($key == 'image') {
                echo '<td><a class="link" href="/assets/images/' . $value . '" target="_blank">' . $value . '</a></td>';
            } else {
                echo '<td>' . htmlspecialchars($value ?? '') . '</td>';
            }
        }
        if ($data_type != 'users') {
            echo '<td class="right-align">
                    <a href="object.php?' . $data_type . '&id=' . $row['id'] . '">
                        <i>edit</i>
                        <div class="tooltip">Редагувати</div>
                    </a>
                    <a object_type="' . $data_type . '" object_id="' . $row['id'] . '">
                        <i>delete</i>
                        <div class="tooltip">Видалити</div>
                    </a>
                  </td>';
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}
