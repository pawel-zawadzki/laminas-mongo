<?php

namespace Application\Fieldset;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Laminas\Form\Fieldset;
use Doctrine\Laminas\Hydrator\DoctrineObject as DoctrineHydrator;

class PostFieldset extends Fieldset
{
    public function __construct(DocumentManager $documentManager)
    {
        parent::__construct('post');

        $this->setHydrator(new DoctrineHydrator($documentManager))->setObject(new Document());

        $this->add([
            'type' => 'text',
            'name' => 'title',
            'options' => [
                'label' => 'Tytuł',
            ]
        ]);
        $this->add([
            'type' => 'textarea',
            'name' => 'body',
            'options' => [
                'label' => 'Treść',
            ]
        ]);
    }

}