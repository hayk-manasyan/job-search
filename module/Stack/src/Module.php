<?php
/**
 * Created by PhpStorm.
 * User: haykma
 * Date: 04/10/2017
 * Time: 17:56
 */

namespace Stack;


class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}