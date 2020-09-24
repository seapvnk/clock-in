<?php

function dayController()
{
    Session::validate();
    Loader::view('DayView');
}
