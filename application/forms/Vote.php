<?php

class Application_Form_Vote extends Zend_Form
{

    public function init()
    {

        $this->setAttrib('role', 'form');
        $this->setAttrib('enctype', 'multipart/form-data');

        $elements = Array();
        $elements['IsGoingVote'] = new Zend_Form_Element_Select('IsGoingVote');
        $elements['IsGoingVote']->setLabel('Are you going to vote?')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->setAllowEmpty(false)
            ->addMultiOptions(Array(
                '' => '- select -',
                '1' => 'Yes',
                '0' => 'No',
            ));

        $constituencyOptions = \Model\ConstituencyQuery::create()->find();
        $options = Array('' => '- select -');
        foreach($constituencyOptions as $constituencyOption) {
            /* @var \Model\Constituency $constituencyOption */
            $options[$constituencyOption->getId()] = $constituencyOption->getName();
        }

        $elements['IdConstituency'] = new Zend_Form_Element_Select('IdConstituency');
        $elements['IdConstituency']->setLabel('Select Your Constituency')
            ->addValidator('NotEmpty')
            ->setAttrib('class', 'form-control')
            ->setRequired(true)
            ->addMultiOptions($options)
            ->addDecorator('Label', array('class' => 'control-label'));

        $elements['Representative'] = new Zend_Form_Element_Text('Representative');
        $elements['Representative']->setLabel('Who are you going to vote for?')
            ->setAttrib('class', 'form-control col-sm-6')
            ->addDecorator('Label', array('class' => 'control-label'));

        $elements['Submit'] = new Zend_Form_Element_Submit('Submit');
        $elements['Submit']->setAttrib('class', 'btn btn-primary btn-block')
            ->setLabel('Save Vote')
            ->addDecorator('ViewHelper');

        $this->addElements($elements);
    }


}

