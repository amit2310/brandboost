<?php if ($template_name == 'Invite SMS'): ?>
    Hi {FIRST_NAME} {LAST_NAME},\n\n

    I hope you are doing well. We have an exciting offer for you.\n\n

    {ADVOCATE_REWARD} \n\n
    {FRIEND_REWARD} \n\n

    Here is the reference link you can share with your friends\n\n

    {REFERRAL_LINK}\n\n

    Regards,\n
    {STORE_NAME}\n
    {STORE_URL}\n

<?php elseif ($template_name == 'Invite SMS Reminder'): ?>
    Hi {FIRST_NAME} {LAST_NAME},\n\n

    It's just for the reminder, We have an exciting offer for you.\n\n

    {ADVOCATE_REWARD} \n\n
    {FRIEND_REWARD} \n\n
    Here is the reference link you can share with your friends\n\n

    {REFERRAL_LINK} \n\n

    Regards,\n
    {STORE_NAME} \n
    {STORE_URL} \n

<?php elseif ($template_name == 'Sale SMS'): ?>
    Hi {FIRST_NAME} {LAST_NAME}, \n\n

    Thank you for your purchase with {STORE_NAME}. Here is a deal for you \n\n

    {ADVOCATE_REWARD} \n\n
    {FRIEND_REWARD} \n\n

    Here is the reference link you can share with your friends

    {REFERRAL_LINK}\n\n

    Regards, \n
    {STORE_NAME} \n
    {STORE_URL} \n

<?php elseif ($template_name == 'Sale SMS Reminder'): ?>
    Hi {FIRST_NAME} {LAST_NAME}, \n\n

    Just to remind you and thank you for your purchase you made with {STORE_NAME}. Here is an offer for you might be interested \n\n

    {ADVOCATE_REWARD} \n\n
    {FRIEND_REWARD} \n\n

    Here is the reference link you can share with your friends\n\n

    {REFERRAL_LINK} \n\n

    Regards, \n
    {STORE_NAME} \n
    {STORE_URL} \n

<?php else: ?>

<?php endif; ?>
