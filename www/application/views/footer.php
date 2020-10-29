            <div id="footer">
                Copyright © 2011 Спутниковое ТВ в Кривом Роге | MASTERSAT<br/>
                Веб-разработка Василихин Сергей <a style="color:#787f9a" href="mailto:sergeyvas@ukr.net">sergeyvas@ukr.net</a>
                <div class="adm">
                    <?php
                    $user_dt = $this->session->userdata(md5('adm_check_ok'));
                    if (!$user_dt)
                        {
                        echo "<a id='adm_button' href=\"javascript:void(0)\">А</a>";
                        } else
                        echo "<a href=\"/admin/go_exit\">Выход</a>";
                    ?>
                </div>
            </div>
        </div>

    </body>
</html>