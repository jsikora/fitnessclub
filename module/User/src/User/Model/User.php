<?php
namespace User\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
/**
 * Class User
 * @package User\Model
 */
class User implements InputFilterAwareInterface {

    /*
     * @var int
     * @Id @Column(type="integer")  @GeneratedValue
     */
    protected $id;

    /**
     * @var string
     * @Column(type="string")
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $firstName;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var integer
     */
    protected $roleId;
    //protected $trainerGroup;

    /**
     * @var integer
     */
    protected $birthYear;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var InputFilterAwareInterface
     */
    protected $inputFilter;

    /**
     * @var string
     */
    protected static $sex;

    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getBirthYear()
    {
        return $this->birthYear;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return self::$sex;
    }

    public function isFemale()
    {
        return (bool)(self::sex === 'f');
    }

    public function isMale()
    {
        return (bool)(self::sex === 'm');
    }


    /**
     * @param $lastName
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }


    public function setSexAsFemale()
    {
        self::$sex = 'f';
    }

    public function setSexAsMale()
    {
        self::$sex = 'm';
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }
    
    

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param $city
     */
    public function setCity($city) {
        $this->city = $city;
    }

    /**
     * @param $birthYear
     */
    public function setBirthYear($birthYear)
    {
        $this->birthYear = $birthYear;
    }
    public function exchangeArray($data) {

        $data = $this->prepareExchangeArray($data);

        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->setEmail($data['email']);
        $this->setFirstName($data['firstName']);
        $this->setLastName($data['lastName']);
        $this->setBirthYear($data['birthYear']);
        $this->setCity($data['city']);

        //$this->roleId = (!empty($data['role_id'])) ? $data['role_id'] : null;
    }

    //it is using by hydrator object for method bind()
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * Filling missing User attributes by empty value;
     * @param array $data
     * @return array
     */
    public function prepareExchangeArray($data = array())
    {
        $data['id']         = (!empty($data['id'])) ? $data['id'] : null;
        $data['email']      = (!empty($data['email'])) ? $data['email'] : null;
        $data['lastName']   = (!empty($data['lastName'])) ? $data['lastName'] : null;
        $data['city']       = (!empty($data['city'])) ? $data['city'] : null;
        $data['birthYear']  = (!empty($data['birthYear'])) ? $data['birthYear'] : null;
        $data['firstName']  = (!empty($data['firstName'])) ? $data['firstName'] : null;
        $data['sex']        = (!empty($data['sex'])) ? $data['sex'] : 'm';
        return $data;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'firstName',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'lastName',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'birthYear',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'email',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 50,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
}