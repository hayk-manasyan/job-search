<?php

namespace Application\Form;


use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class SearchForm extends Form
{

    public function init()
    {
        $position = new Text('position');

        $position = new Select('position');
        $position->setEmptyOption('All');
        $position->setValueOptions([
            'php' => 'PHP',
            'java' => 'JAVA',
            'nodejs' => 'NodeJS',
            'javascript' => 'Javascript',
            'c#' => 'C#',
            '.net' => '.Net'
        ]);

        $position->setAttributes([
            'class' => 'form-control',
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