<div id="right">
    <div class="top">
        <h1>Новости</h1>
        <?php
        if (isset($news) and $news != '')
            {
            foreach ($news as $val)
                {
                echo '<ul class="items_list">';
                echo '<li><a href="/news/item/' . $val['id'] . '">' . $val['name'] . '</a><span class="date_li">'.date('d.m.y',$val['date']).'</span></li>';
                echo '</ul>';
                }
            }
        else
            echo '<p>Раздел находится в стадии разработки</p>';
        ?>
    </div>
</div>
</div>