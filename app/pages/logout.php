<?php

    if(!empty($_SESSION['user'])){
        unset($SESSION['user']);
        session_destroy();
    }
    redirect('home');

?>