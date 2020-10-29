<div id="cont">
    <div id="left">
        <div class="l_m_perm">
            <ul>
                <?php
                if (($this->session->userdata(md5('adm_check_ok')) == md5('accepted_111')))
                    {
                    $seg_3 = $this->uri->segment('3');
                    if ($seg_3 == 'viasat')
                        {
                        echo ' <li class="active">Виасат</li>
                               <li><a href="/admin/edit_it/xtra/">Xtra TV</a></li>';
                        }
                    elseif ($seg_3 == 'xtra')
                        {
                        echo ' <li><a href="/admin/edit_it/viasat/">Виасат</a></li>
                               <li class="active">Xtra TV</li>';
                        }
                    else
                        {
                        echo ' <li><a href="/admin/edit_it/viasat/">Виасат</a></li>
                               <li><a href="/admin/edit_it/xtra/">Xtra TV</a></li>';
                        }
                    }
                else
                    {
                    switch ($this->uri->segment(2))
                        {
                        case 'xtra': echo ' <li><a href="/tv/viasat/">Виасат</a></li>
                                            <li class="active">Xtra TV</li>';
                            break;
                        case 'viasat':echo ' <li class="active">Виасат</li>
                                            <li><a href="/tv/xtra/">Xtra TV</a></li>';
                            break;
                        default : echo ' <li><a href="/tv/viasat/">Виасат</a></li>
                                            <li><a href="/tv/xtra/">Xtra TV</a></li>';
                            break;
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="news">
            <h2>Новости</h2>
            <?php
            if (isset($l_news) AND $l_news != '')
                {
                echo '<h4>' . $l_news['name'] . '</h4>';
                echo '<div class="n_bl">' . $l_news['data'] . '...</div>';
                echo '<a href="/news/item/' . $l_news['id'] . '">Далее</a>
                          <div class="n_date">' . date('d.m.y', $l_news['date']) . '</div>';
                }
            else
                echo '<h2>Нет новостей</h2>';
            ?>
            <div class="bg"></div>
        </div>
        <div class='inf_bl'>
        <div id=tv_informer><table cellspacing=0 cellpadding=0><tr><td><table border=1 rules=rows cellspacing=0 cellpadding=0 bgcolor=ffffff width=214 style='font-family:arial cyr,arial;font-size:11px;'><tr><th bgcolor=ffffff><a href='http://tv.gameclubsite.com' style='color:000000;'>Программа ТВ</a></th></tr><tr><th bgcolor=ffffff><a href='http://www.gameclubsite.com/' style='color:000000;'>GameClub игры онлайн</a></th></tr></table></td><tr><th><a href='http://tv-informer.gameclubsite.com' style='color:000000;background-color:ffffff;font-family:arial cyr,arial;font-size:9px;'>поставьте cебе</a></th></tr></table></div><script src='http://tv-informer.gameclubsite.com/informer.php?rn=10&c=3&w=214&tz=-32&p=1&s=1&'+Math.random();></script> </div>
        <div class="adv_block">
            <script type="text/javascript"><!--
                google_ad_client = "ca-pub-1696794699587469";
                /* 160x600, создано 31.07.11 */
                google_ad_slot = "5304668868";
                google_ad_width = 160;
                google_ad_height = 600;
                //-->
            </script>
            <script type="text/javascript"
                    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
            </script>

        </div>

        <div class="counter">
            <!-- Yandex.Metrika informer -->
            <a href="http://metrika.yandex.ru/stat/?id=7851052&amp;from=informer"
               target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/7851052/3_1_575BB8FF_373B98FF_0_pageviews"
                                                style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:7851052,lang:'ru'});return false}catch(e){}"/></a>
            <!-- /Yandex.Metrika informer -->

            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
                (function (d, w, c) {
                    (w[c] = w[c] || []).push(function() {
                        try {
                            w.yaCounter7851052 = new Ya.Metrika({id:7851052,
                                clickmap:true,
                                trackLinks:true,
                                accurateTrackBounce:true});
                        } catch(e) { }
                    });

                    var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                    s.type = "text/javascript";
                    s.async = true;
                    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                    if (w.opera == "[object Opera]") {
                        d.addEventListener("DOMContentLoaded", f, false);
                    } else { f(); }
                })(document, window, "yandex_metrika_callbacks");
            </script>
            <noscript><div><img src="//mc.yandex.ru/watch/7851052" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
            <!-- /Yandex.Metrika counter -->

        </div>
    </div>