<?php

namespace App\Repositories;

abstract class Repository
{
    abstract function store();


    abstract function update();


    abstract function destroy();
}
