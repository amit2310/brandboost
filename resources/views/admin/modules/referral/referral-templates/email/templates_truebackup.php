<?php if ($template_name == 'Invite Email'): ?>
    Hello My Friend {FIRST_NAME},<br><br>

    I hope you are doing well. We have an exciting offer for you.<br><br>

    <div style="text-align: center;"><b>{ADVOCATE_REWARD}</b></div>
    <div style="text-align: center;"><br></div>
    <div style="text-align: center;"><b>{FRIEND_REWARD}</b></div><br>
    Here is the reference link you can share with your friends<br><br>

    <div><div style="text-align: center;"><b>{REFERRAL_LINK}</b></div><br><br>

        <div>Keep sharing and let us know how did it go.<br><br>

            See you soon<b><br><br>


            </b>Regards,<br>
            {STORE_NAME}<br>
            {STORE_URL}<b><br></b>


        </div>
    </div>
    <div class="wysiwyg-text-align-center"></div>
<?php elseif ($template_name == 'Invite Email Reminder'): ?>
    Hi {FIRST_NAME} {LAST_NAME},<br><br>

    It's just for the reminder, We have an exciting offer for you.<br><br>

    <div style="text-align: center;"><b>{ADVOCATE_REWARD}</b></div>
    <div style="text-align: center;"><br></div>
    <div style="text-align: center;"><b>{FRIEND_REWARD}</b></div><br>
    Here is the reference link you can share with your friends<br><br>

    <div><div style="text-align: center;"><b>{REFERRAL_LINK}</b></div><br><br>

        <div>Keep sharing and let us know how did it go.<br><br>

            See you soon<b><br><br>


            </b>Regards,<br>
            {STORE_NAME}<br>
            {STORE_URL}<b><br></b>


        </div>
    </div>
    <div class="wysiwyg-text-align-center"></div>
<?php elseif ($template_name == 'Sale Email'): ?>
    Hi {FIRST_NAME} {LAST_NAME},<br><br>

    Thank you for your purchase with {STORE_NAME}. Here is a deal for you<br><br>

    <div style="text-align: center;"><b>{ADVOCATE_REWARD}</b></div>
    <div style="text-align: center;"><br></div>
    <div style="text-align: center;"><b>{FRIEND_REWARD}</b></div><br>
    Here is the reference link you can share with your friends<br><br>

    <div><div style="text-align: center;"><b>{REFERRAL_LINK}</b></div><br><br>

        <div>Keep shopping and sharing your referral link.<br><br><br>


            </b>Regards,<br>
            {STORE_NAME}<br>
            {STORE_URL}<b><br></b>


        </div>
    </div>
    <div class="wysiwyg-text-align-center"></div>
    <?php elseif ($template_name == 'Sale Email Reminder'): ?>
    Hi {FIRST_NAME} {LAST_NAME},<br><br>

    Just to remind you and thank you for your purchase you made with {STORE_NAME}. Here is an offer for you might be interested<br><br>

    <div style="text-align: center;"><b>{ADVOCATE_REWARD}</b></div>
    <div style="text-align: center;"><br></div>
    <div style="text-align: center;"><b>{FRIEND_REWARD}</b></div><br>
    Here is the reference link you can share with your friends<br><br>

    <div><div style="text-align: center;"><b>{REFERRAL_LINK}</b></div><br><br>

        <div>Keep shopping and sharing your referral link.<br><br><br>


            </b>Regards,<br>
            {STORE_NAME}<br>
            {STORE_URL}<b><br></b>


        </div>
    </div>
    <div class="wysiwyg-text-align-center"></div>
<?php else: ?>
    
<?php endif; ?>
