<?php

    $to = 'faizalardianputra@yahoo.co.id';

    $subject = 'Testing Mail PHP';

    $message = '
    
    Testing Mail PHP From Localhost
    from Yuk Bali

    -Faizal
    ';

    $headers = 'From:noreply@yukbali.com'.'\r\n';

    $sukses = mail($to,$subject,$message,$headers);
var_dump($sukses);
?>