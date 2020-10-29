<div id="right">
    <div class="top">
        <h3>
            <?php
            echo validation_errors();
            if (isset($error) && $error != '')
                echo $error;
            else
                echo 'Произошла ошибка ';
            ?>
        </h3>
        <a href="/">Вернуться на главную</a>
    </div>
</div>
</div>
