<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace MartyBel\Tripolis\Service;


class PublishingService extends AbstractService
{

    public function publishTransactionalEmail($contactId,$emailId,$mailJobTags = array())
    {
        $body = array(
            'contactId'     => $contactId,
            'directEmailId' => $emailId,
            'mailJobTagIds' => array(
                'mailJobTagId' => $mailJobTags
            )
        );

        return $this->invoke(__FUNCTION__,$body);
    }

  /**
   *
   * @param $eId
   * @param $contactGroupId
   * @param array $mailJobTags
   * @return mixed
   */
    public function publishEmail($eId, $contactGroupId, $mailJobTags = array())
    {
      $body = array(
        'contactGroupId' => $contactGroupId,
        'newsletterId'	 => $eId,
        'mailsPerHour'	 => 10000,
        'mailJobTagIds' => array(
          'mailJobTagId' => $mailJobTags
        )
      );

      return $this->invoke(__FUNCTION__,$body);
    }

  /**
   *
   * @param $dmId
   * @param $contactGroupId
   * @param array $mailJobTags
   * @return mixed
   */
    public function publishDirectEmail($dmId, $contactGroupId, $mailJobTags = array())
    {
      $body = array(
        'contactGroupId' => $contactGroupId,
        'directEmailId'	 => $dmId,
        'mailsPerHour'	 => 10000,
        'mailJobTagIds'  => array(
          'mailJobTagId' => $mailJobTags
        )
      );

      //var_dump($body); exit();

      return $this->invoke('publishEmail',$body);
    }
}