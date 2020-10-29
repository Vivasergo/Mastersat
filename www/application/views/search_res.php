<div id="right">
    <div class="top">
        <h1>Результат поиска</h1>
        <?php
        if (isset($search) and $search != '')
            {
            echo '<ol class="search_list">';
            foreach ($search as $key)
                {
                echo '<li><a href="/' . $key['rel_key'] . '/item/' . $key['id'] . '">' . $key['name'] . '</a><p>' . $key['data'] . '</p></li>';
                }
            echo '</ol>';
            }
        else
            echo '<p>По вашему запросу ничего не найдено</p>';
        ?>
    </div>
</div>
</div>