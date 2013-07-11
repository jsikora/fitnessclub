<?php
namespace User\Controller;

use User\Model\UserTable;
use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Model\User;
use User\Form\UserForm;

class UserController extends AbstractActionController
{
    /**
     * @var UserTable
     */
    protected $userTable;

    public function indexAction() {
        return new ViewModel(array(
            'users' => $this->getUserTable()->fetchAll(),
        ));
    }

    /**
     * Prints adding user form or saves input data
     * @return array|\Zend\Http\Response
     */
    public function addAction()
    {
        $form = new UserForm();
        $form->get('submit-add-user')->setValue('Add');

        $request = $this->getRequest();
        if($request->isPost()) {
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());
            if($form->isValid()) {
                $user->exchangeArray($form->getData());
                $this->getUserTable()->saveUser($user);
                return $this->redirect()->toRoute('user');
            }
        }
        return array('form' => $form);
    }

    public function editAction() {

    }

    public function deleteAction() {

    }

    /**
     * @return array|object|UserTable
     */
    public function getUserTable()
    {
        if(!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('User\Model\UserTable');
        }

        return $this->userTable;
    }
}