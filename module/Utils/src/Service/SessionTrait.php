<?php

namespace Utils\Service;


use Zend\Session\Container;

trait SessionTrait
{


    protected $sessionContainer;

    public function getSession($sessionName = 'GifterySession')
    {
        if(is_null($this->sessionContainer)) {
            $this->setSession($sessionName);
        }

        return $this->sessionContainer;
    }

    protected function setSession($sessionName)
    {
        $this->sessionContainer = new Container($sessionName);
        return $this;
    }

}