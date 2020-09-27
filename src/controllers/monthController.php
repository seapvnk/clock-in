<?php

Loader::model('WorkingHours');

function monthController()
{
    Session::validate();


    Loader::view('Month', [
    ]);
}
