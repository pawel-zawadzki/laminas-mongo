<?php

declare(strict_types=1);

namespace Application\Controller;

use Application\Document\Post;
use Application\Form\PostForm;
use Doctrine\ODM\MongoDB\DocumentManager;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function __construct(private DocumentManager $documentManager, private PostForm $form)
    {
    }

    public function indexAction()
    {
        $posts = $this->documentManager->getRepository(Post::class)->findAll();

        return new ViewModel(['form' => $this->form, 'posts' => $posts]);
    }

    public function addAction() {
        $post = new Post();

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $this->form->bind($post);
            $this->form->setData($data);

            if ($this->form->isValid()) {
                $this->documentManager->persist($post);
                $this->documentManager->flush();
            }
        }

        return $this->redirect()->toRoute('home');
    }
}
