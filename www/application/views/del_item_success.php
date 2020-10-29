<div id="right">
    <div class="top">
        <h3>
            <?php
            echo validation_errors();
            if (isset($success) && $success != '')
                echo $success;
            else
                echo 'Произошла ошибка ';
            ?>
        </h3>
        <a href="/admin/">Вернуться в административную панель</a>
    </div>
</div>
</div>
