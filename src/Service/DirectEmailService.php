<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace HarperJones\Tripolis\Service;



class DirectEmailService extends AbstractService
{
    public function getByDirectEmailTypeId($dmTypeId)
    {
        $response = $this->getMethodCache(__METHOD__,$dmTypeId);

        if ( $response !== false ) {
            return $response;
        }

        $body = array(
            'directEmailTypeId' => $dmTypeId
        );

        return $this->setMethodCache(__METHOD__,$dmTypeId,$this->invoke(__FUNCTION__,$body));
    }

    public function getById($dmId)
    {
        return $this->invoke(__FUNCTION__,array('id' => $dmId));
    }
}