<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace HarperJones\Tripolis\Service;


class DirectEmailTypeService extends AbstractService
{
    public function getByWorkspaceId($workspace)
    {
        $response = $this->getMethodCache(__METHOD__,$workspace);

        if ( $response !== false ) {
            return $response;
        }

        $body = array(
            'workspaceId' => $workspace
        );

        return $this->setMethodCache(__METHOD__,$workspace,$this->invoke(__FUNCTION__,$body));
    }
}