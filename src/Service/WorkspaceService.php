<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace HarperJones\Tripolis\Service;


class WorkspaceService extends AbstractService
{
    public function getByContactDatabaseId($dbId)
    {
        $response = $this->getMethodCache(__METHOD__,$dbId);

        if ( $response !== false ) {
            return $response;
        }

        $body = array(
            'contactDatabaseId' => $dbId
        );

        return $this->setMethodCache(__METHOD__,$dbId,$this->invoke(__FUNCTION__,$body));
    }
}