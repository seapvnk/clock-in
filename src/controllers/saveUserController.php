<?php

function saveUserController()
{
    Session::validate();

    Loader::model('User');
    
    Loader::view('SaveUser', [
    ]);
}