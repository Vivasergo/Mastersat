<div id="right">
    <div class="top">
        <h3>
            <?php
            if (isset($mess) && $mess != '')
                echo $mess;
            else
                echo 'Произошла ошибка';
            ?>
        </h3>
        <?php
            if (isset($info) && $info != '')
                echo '<p>'.$info.'</p>';
            ?>
        <div><a href="/main/">Вернуться на главную</a></div>
    </div>
</div>
</div>
