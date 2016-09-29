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

    public function create($setup)
    {
      return $this->invoke(__FUNCTION__,$setup);
    }

    public function update($id,$html,$text = null)
    {
      $body = array(
        'id'        => $id,
        'htmlSource'=> $html,
      );

      if ( $text === null ) {
        $body['textSource'] = $text;
      }

      return $this->invoke(__FUNCTION__,$body);
    }
}