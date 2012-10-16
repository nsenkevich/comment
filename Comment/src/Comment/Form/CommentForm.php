<?php
namespace Comment\Form;

use Zend\Form\Form;

class CommentForm extends Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setName('Comment');
        $this->setAttribute('method', 'post');

        // Id
        $this->add(array(
            'name' => 'url',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));

        // Artist        
        $this->add(array(
            'name' => 'comment',
            'attributes' => array(
                'type'  => 'text',
                'label' => 'Artist',
            ),
        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'label' => 'Go',
                'id' => 'submitbutton',
            ),
        ));

    }
}
