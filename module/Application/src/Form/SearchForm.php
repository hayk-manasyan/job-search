<?php

namespace Application\Form;


use Zend\Form\Element\Text;
use Zend\Form\Form;

class SearchForm extends Form
{

    public function init()
    {
        $position = new Text('position');
        $position->setAttributes([
            'class' => 'form-control has-feedback-left',
            'maxlength' => 10,
            'placeholder' => "PHP, JAVA, ...",
        ]);

        $this->add($position);

        $location = new Text('location');
        $location->setAttributes([
            'class' => 'form-control has-feedback-left',
            'maxlength' => 20,
            'placeholder' => "London, Berlin, ...",
        ]);

        $this->add($location);
    }
}