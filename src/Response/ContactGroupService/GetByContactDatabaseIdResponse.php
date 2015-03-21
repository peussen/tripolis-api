<?php
/**
 * Created by PhpStorm.
 * User: petereussen
 * Date: 25/08/14
 * Time: 16:23
 */

namespace HarperJones\Tripolis\Response\ContactGroupService;


use HarperJones\Tripolis\Response\AbstractIteratorResponse;

class GetByContactDatabaseIdResponse extends AbstractIteratorResponse
{

	public function parseResponse($reply)
	{
		$this->populate($reply,'contactGroups','contactGroup');
	}
} 