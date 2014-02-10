<?php

class VoteController extends Zend_Controller_Action
{

    public function init()
    {
        $this->urlHelper = $this->getHelper('url');
    }

    public function indexAction()
    {
        $form = new Application_Form_Vote();

        $request = $this->getRequest();

        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $vote = new \Model\Vote();
                $vote->fromArray($form->getValues());
                $vote->save();

                $where = $this->urlHelper->url(
                    array(
                        'module' => 'default',
                        'controller' => 'vote',
                        'action' => 'voted'
                    ));
                $this->redirect($where);
            }
        }

        $this->view->form = $form;
    }

    public function votedAction()
    {

    }


}



