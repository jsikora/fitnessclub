<?php
namespace User\Model;

/**
 * Class User
 * @package User\Model
 */
class User {

    /*
     * @var int
     * @Id @Column(type="integer")  @GeneratedValue
     */
    public $id;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $name;
    protected $mail;
    protected $roleId;
    protected $trainerGroup;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->roleId = (!empty($data['role_id'])) ? $data['role_id'] : null;

    }
}