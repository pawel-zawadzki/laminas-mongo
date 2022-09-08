<?php

namespace Application\Form;

use Application\Fieldset\PostFieldset;
use Doctrine\ODM\MongoDB\DocumentManager;
use Laminas\Form\Form;
use Doctrine\Laminas\Hydrator\DoctrineObject as DoctrineHydrator;

class PostForm extends Form
{
    public function __construct(DocumentManager $documentManager)
    {
        parent::__construct('post');

        $this->setAttribute('method', 'post');

        $this->setHydrator(new DoctrineHydrator($documentManager));

        $fieldset = new PostFieldset($documentManager);
        $fieldset->setUseAsBaseFieldset(true);
        $this->add($fieldset);

        $this->add([
            'type' => 'submit',
            'name' => 'save',
            'attributes' => [
                'value' => 'Zapisz'
            ],
        ]);
    }

}