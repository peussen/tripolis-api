<?php
/**
 * Created by PhpStorm.
 * User: petereussen
 * Date: 25/08/14
 * Time: 12:02
 */

namespace HarperJones\Tripolis\Service;


class ContactDatabaseService extends AbstractService
{
	public function all()
	{
		$response = $this->getMethodCache(__METHOD__,null);

		if ( $response !== false ) {
			return $response;
		}

		$body = array(
			'getAll' => array('getAllRequest' => '')
		);

		return $this->setMethodCache(__METHOD__,null,$this->getAll($body));
	}
} 