<?php

function logoutController() {
    session_destroy();
    Utility::redirect('login');
}
