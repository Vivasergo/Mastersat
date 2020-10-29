<div id="right">
    <div class="top">
        <?php
        if (isset($item_data) and $item_data != '') {
            foreach ($item_data as $key) {
                echo $key;
            }
        }
        else
            echo '<p>Раздел находится в стадии разработки</p>';
        ?>
    </div>
    <div class="animation">
        <div id="an_bl_1" style="position: relative;"></div>
    </div>
</div>
</div>