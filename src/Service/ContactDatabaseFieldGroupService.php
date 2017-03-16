<?php
/**
 * Created by PhpStorm.
 * User: petereussen
 * Date: 25/08/14
 * Time: 15:51
 */

namespace MartyBel\Tripolis\Service;

use MartyBel\Tripolis\Service\DatabaseTrait;

class ContactDatabaseFieldGroupService extends AbstractService
{
	use DatabaseTrait;


	public function getByContactDatabaseId($id = null)
	{
		$id = $this->negotiateDB($id);

		$body = array(
			'contactDatabaseId' => $id
		);

		return $this->invoke(__FUNCTION__,$body);
	}

	public function all($db = null)
	{
		return $this->getByContactDatabaseId($db);
	}
} 