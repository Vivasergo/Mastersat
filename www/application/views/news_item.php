<div id="right">
    <div class="top">
        <?php
        echo '<h1>' . $item['name'] . '</h1>';
        echo '<div class="date_div">'.date('d.m.y',$item['date']).'</div>';
        if (isset($item_data) and $item_data != '') {
            foreach ($item_data as $key) {
                echo $key;
            }
        }
        else
            echo '<p>Раздел находится в стадии разработки</p>';
        ?>
    </div>
</div>
</div>