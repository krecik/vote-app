<?php

class Application_Form_Vote extends Zend_Form
{

    public function init()
    {

        $this->setAttrib('role', 'form');
        $this->setAttrib('enctype', 'multipart/form-data');

        $elements = Array();
//        $elements['Id'] = new Zend_Form_Element_Hidden('Id');
        $elements['IsGoingVote'] = new Zend_Form_Element_Radio('IsGoingVote');
        $elements['IsGoingVote']->setLabel('Are you going to vote?')
            ->setAttrib('class', 'input-lg')
            ->setRequired(true)
            ->setAllowEmpty(false)
            ->addMultiOptions(Array(
                '1' => 'Yes',
                '0' => 'No',
            ))
            ->addDecorator('Label', array('class' => 'radio-inline'))
            ->addDecorator('ViewHelper', array('class' => 'radio-inline'))
            ->setSeparator('');

        $constituencyOptions = \Model\ConstituencyQuery::create()->find();
        $options = Array();
        foreach($constituencyOptions as $constituencyOption) {
            /* @var \Model\Constituency $constituencyOption */
            $options[$constituencyOption->getId()] = $constituencyOption->getName();
        }

        $elements['IdConstituency'] = new Zend_Form_Element_Select('IdConstituency');
        $elements['IdConstituency']->setLabel('Select Your Constituency')
            ->addValidator('NotEmpty')
            ->addMultiOptions($options)
            ->addDecorator('Label', array('class' => 'control-label'));

        $elements['Representative'] = new Zend_Form_Element_Text('Representative');
        $elements['Representative']->setLabel('Who are you going to vote for?')
            ->addDecorator('Label', array('class' => 'control-label'));

        $elements['Submit'] = new Zend_Form_Element_Submit('Submit');
        $elements['Submit']->setAttrib('class', 'btn btn-primary')
            ->setLabel('Save Vote')
            ->addDecorator('ViewHelper');

        $this->addElements($elements);
    }


}

