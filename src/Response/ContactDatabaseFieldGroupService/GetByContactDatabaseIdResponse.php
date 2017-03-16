<?php
/**
 * Created by PhpStorm.
 * User: petereussen
 * Date: 25/08/14
 * Time: 16:02
 */

namespace MartyBel\Tripolis\Response\ContactDatabaseFieldGroupService;


use MartyBel\Tripolis\Response\AbstractIteratorResponse;

class GetByContactDatabaseIdResponse extends AbstractIteratorResponse
{
	public function parseResponse($reply)
	{
		$this->populate($reply,'contactDatabaseFieldGroups','contactDatabaseFieldGroup');
	}
} 