<?php
/**
 * Created by PhpStorm.
 * User: hayk
 * Date: 8/21/17
 * Time: 1:09 PM
 */

namespace Github;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}