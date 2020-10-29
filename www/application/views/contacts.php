<div id="right">
    <div class="top">
        <h1>Контакты</h1>
        <?php
        if (isset($item_data) and $item_data != '')
            {
            foreach ($item_data as $key)
                {
                echo $key;
                }
            }
        ?>
        <div class="qes_form">
            <h4>
                Вы можете задать вопрос, заполнив форму ниже. И наши сотрудники свяжутся с вами в ближайшее время.
            </h4>
            <form id="mail_us" method="post" action="/contacts/mail_us/">
                <table>
                    <tr>
                        <td>Название организации:</td>
                        <td><input type="text" name="organization" value="<? echo set_value('organization'); ?>" size="45" />
                        </td>
                    </tr>
                    <tr>
                        <td>Контактное лицо:</td>
                        <td><input type="text" name="person" value="<? echo set_value('person'); ?>" size="45" /></td>
                    </tr>
                    <tr>
                        <td>Ваш E-mail: <span style="color:red">*</span></td>
                        <td><input class="required" type="text" name="e-mail" value="<? echo set_value('e-mail'); ?>" size="45" />
                        </td>
                    </tr>
                    <?php echo '<tr><td style="color:red; padding-left:15px; font-size:10px;" colspan="2">' . form_error('e-mail', '<span class="error">', '</span>') . "</td></tr>"; ?>
                    <tr>
                        <td>Номер контактного телефона:</td>
                        <td><input id="phone" type="text" name="phone" value="<? echo set_value('phone'); ?>" size="45" /></td>
                    </tr>
                    <tr>
                        <td>Ваше сообщение: <span style="color:red">*</span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><textarea  class="required" name="message" value="<? echo set_value('message'); ?>" cols="55" rows="10"></textarea><br/>
                            <span style="color:red">*</span> <span>- поля для обязательного заполнения</span>
                    </tr>
                    <?php echo '<tr><td style="color:red; padding-left:15px; font-size:10px;" colspan="2">' . form_error('message', '<span class="error">', '</span>') . "</td></tr>"; ?>
                    <tr>
                        <td><input id="sub_mail" type="submit" value="Отправить сообщение" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</div>