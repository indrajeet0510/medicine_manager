<html>
<body>
<div style="font-family:Squada one,Arial, Helvetica, sans-serif; font-size:19px; color:#444; ">
    <div align="center" style="color:#498DD2; font-size:32px; padding-top:10px; padding-bottom:10px; border-bottom:1px solid #DDD; margin-bottom:15px; font-weight:400;">
        Retalics
        <span style="color:#333; padding-left:05px;font-size:25px;">
                    ...
                </span>
    </div>
</div>

<div style="padding: 0 0 0 20px;font-weight: bold;font-size: 14px;">
    Dear <?php echo $uname ?>,
    <p style="text-align: center;"><?php echo $msg ?></p>
</div>
<div style="padding: 20px 0 20px 20px;">
    <?php echo $content ?>
</div>
<div style="font-size:14px;margin-bottom:20px;padding: 0 0 0 20px;">
    Thank you for using Retalics!<br />--Team Retalics<br /><?php echo ConfigurationManager::SITE_URL ?>
</div>
<div style="font-size:14px;margin-bottom:20px;padding: 0 0 0 20px;">&copy; 2014, <a href="<?php echo ConfigurationManager::SITE_URL ?>">Retalics.com</a></div>
<div style="padding: 0 0 0 20px;text-align: center;">------------------------- DISCLAIMER -------------------------<br />
    <p style="text-align: justify;">The information contained in this electronic message (including any accompanying documents) is solely intended for the information of the addressee(s) and is proprietary,
        confidential or privileged information. This information should not be reproduced or redistributed or passed on directly or indirectly in any form to any other person.
        If you are not the named addressee, you are hereby notified that any disclosure, copying, distribution or taking any action in reliance on the contents of this e-mail
        or any accompanying document is strictly prohibited and is unlawful. Kindly notify the sender or email to <?php echo ConfigurationManager::SITE_CONTACT_MAIL ?> immediately and destroy all copies of this
        e-mail and any attachments there to. Any views or opinions expressed in this email are solely those of the sender and may be modified or altered and may not necessarily
        reflect the views or policies of Retalics.com. as an organization. Retalics or its directors/employees shall not be liable for any damage whether direct/indirect, special
        or consequential, including loss of revenue or profit that may rise from or in connection with use of the information based on this mail.</p>
</div>

<div style="padding: 0 0 0 20px;text-align: center;">-------------------------- WARNING -------------------------<br />
    <p style="text-align: justify;">This e-mail does not tantamount to spamming. Retalics accepts no liability for any damage caused by any malware transmitted by this email.
        The recipient should check this email and any attachments for the presence of viruses and other malwares.
        Sender is not responsible for any damage caused by any virus or alteration of this email by a third-party or otherwise.</p>
</div>
</body>
</html>