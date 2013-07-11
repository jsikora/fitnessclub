<?php
namespace User\Form;

use Zend\Form\Form;

class UserForm extends Form
{
    public function __construct($name = null) {
        parent::__construct('user');
        $this->setAttribute('method','post');
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden'
        ));
        $this->add(array(
            'name' => 'first_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'First name'
            )
        ));

        $this->add(array(
            'name' => 'second_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Second name'
            )
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'options' => array(
                'label' => 'Email'
            )
        ));

        $this->add(array(
           'name' => 'submit-add-user',
            'type' => 'Submit',
            'options' => array(
                'value' => 'Go',
                'id' => 'submitbutton'
            )
        ));

    }
}
