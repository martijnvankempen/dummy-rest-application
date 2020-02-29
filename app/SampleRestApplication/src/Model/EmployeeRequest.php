<?php

namespace App\Model;

use JMS\Serializer\Annotation\Type;

class EmployeeRequest
{

    /**
     * @Type("string")
     */
	public $name;

    /**
     * @Type("int")
     */
	public $age;

    /**
     * @Type("int")
     */
	public $salary;

}