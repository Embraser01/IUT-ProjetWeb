<?php //module/Album/src/Album/Model/User.php
namespace Album\Model;

use Zend\Form\Annotation;

/**
* @Annotation\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
* @Annotation\Name("User")
*/
class User
{
/**
* @Annotation\Required({"required":"true" })
* @Annotation\Filter({"name":"StripTags"})
*/
public $username;

/**
* @Annotation\Type("Zend\Form\Element\Password")
* @Annotation\Required({"required":"true" })
* @Annotation\Filter({"name":"StripTags"})
*/
public $password;

/**
* @Annotation\Type("Zend\Form\Element\Checkbox")
*/
public $rememberme;

/**
* @Annotation\Type("Zend\Form\Element\Submit")
* @Annotation\Attributes({"value":"Submit"})
*/
public $submit;
}