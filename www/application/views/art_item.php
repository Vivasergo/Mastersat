<div id="right">
    <div class="top">
        <?php
        echo '<h1>' . $item['name'] . '</h1>';
        if (isset($item_data) and $item_data != '') {
            foreach ($item_data as $key) {
                echo $key;
            }
        }
        else
            echo '<p>Статья находится в стадии разработки</p>';
        ?>
    </div>
</div>
</div>