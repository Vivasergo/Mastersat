<div id="right">
    <div class="top">
        <h1>Xtra TV! Что это?</h1>
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
</div>
</div>