<?php

function logoutController() {
    session_start();
    session_destroy();
    Utility::redirect('login');
}
