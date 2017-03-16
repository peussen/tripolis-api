<?php
/**
 * Created by PhpStorm.
 * User: petereussen
 * Date: 25/08/14
 * Time: 16:23
 */

namespace MartyBel\Tripolis\Response\ContactGroupService;


use MartyBel\Tripolis\Response\AbstractIteratorResponse;

class GetByContactDatabaseIdResponse extends AbstractIteratorResponse
{

	public function parseResponse($reply)
	{
		$this->populate($reply,'contactGroups','contactGroup');
	}
} 