<?php
/**
 * Created by PhpStorm.
 * User: hayk
 * Date: 8/16/17
 * Time: 3:14 PM
 */

namespace Application\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class FormsController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function advancedAction()
    {

    }
}