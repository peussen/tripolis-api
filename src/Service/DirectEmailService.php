<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace MartyBel\Tripolis\Service;



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

    public function update($id,$html,$text = null, $subject = false)
    {
      $body = array(
        'id'        => $id,
        'htmlSource'=> $html,
      );

      if ( $text === null ) {
        $body['textSource'] = $text;
      }

      if ( !empty($subject) ) {
        $body['subject'] = $subject;
      }

      return $this->invoke(__FUNCTION__,$body);
    }
}