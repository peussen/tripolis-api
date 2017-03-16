<?php
/**
 * Created by PhpStorm.
 * User: petereussen
 * Date: 25/08/14
 * Time: 15:40
 */

namespace MartyBel\Tripolis\Response\ContactDatabaseFieldService;


use MartyBel\Tripolis\Response;

class GetByContactDatabaseIdResponse extends Response\AbstractIteratorResponse
{
	protected function parseResponse( $reply ) {
		$this->populate($reply,'contactDatabaseFields','contactDatabaseField');
	}

} 