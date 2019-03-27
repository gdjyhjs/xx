<?php

if(isset($_POST['platfrom']) && isset($_POST['channel']))
    if($_POST['platfrom'] == 'and' && $_POST['channel'] == 'hjs')
        echo 'http://yellowshange.com/hotupdate/res/Android/';
    else if($_POST['platfrom'] == 'ios' && $_POST['channel'] == 'hjs')
        echo 'http://www.yellowshange.com/hotupdate/res/IOS/';
    else
        echo 'http://www.yellowshange.com/hotupdate/res/Windows/';
else
    echo 'http://www.yellowshange.com/hotupdate/res/Windows/';

?>
