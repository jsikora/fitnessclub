<?php
namespace User\Model;

use Doctrine\DBAL\Schema\Table;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class UserTable
 * @package User\Model
 */
class UserTable
{
    protected $tableGateway;

    /**
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getUser($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveUser(User $user)
    {
        $data = array(
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'birthYear' => $user->getBirthYear(),
            'email'  => $user->getEmail(),
        );

        $id = (int)$user->getId();
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($id)) {
                $this->tableGateway->update($data, array('id' => $id));

            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteUser($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}