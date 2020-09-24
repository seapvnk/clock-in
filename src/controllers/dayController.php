<?php

function dayController()
{
    session_start();
    Session::validate();
    Loader::view('DayView');
}
