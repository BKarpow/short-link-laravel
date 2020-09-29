<?php

use App\Configs;

/**
 * Повертає конфігурацію з бази данних
 * @return Configs
 */
function conf():Configs
{
    return new Configs();
}
