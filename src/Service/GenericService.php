<?php
/**
 * Created by PhpStorm.
 * User: petereussen
 * Date: 25/08/14
 * Time: 09:45
 */

namespace MartyBel\Tripolis\Service;

use MartyBel\Tripolis\TripolisProvider;

class GenericService extends AbstractService
{

	public function __construct(TripolisProvider $provider)
	{
		parent::__construct($provider);
	}

	public function setServiceName($name)
	{
		parent::setServiceName($name);
		$this->setServiceURI('/api2/soap/' . ucfirst($name) . '?wsdl');
		return $this;
	}

}