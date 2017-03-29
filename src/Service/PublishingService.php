<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace MartyBel\Tripolis\Service;


class PublishingService extends AbstractService
{

    /**
     * Publishes as tranactional Email
     *
     * @param $contactId
     * @param $emailId
     * @param array $mailJobTags
     * @param array|bool $body
     * @return mixed
     */
    public function publishTransactionalEmail($contactId,$emailId,$mailJobTags = array(),$body = false)
    {
        if ( $body ) {
            $body['contactId']      = $contactId;
            $body['directEmailId']  = $emailId;

            if ( $mailJobTags ) {
                if ( isset($body['mailJobTagIds'])) {
                    $body['mailJobTagIds'] = array_unique(array_merge($body['mailJobTagIds'],$mailJobTags));
                } else {
                    $body['mailJobTagIds'] = $mailJobTags;
                }
            }
        } else {
            $body = array(
                'contactId'     => $contactId,
                'directEmailId' => $emailId,
                'mailJobTagIds' => array(
                    'mailJobTagId' => $mailJobTags
                )
            );
        }

        return $this->invoke(__FUNCTION__,$body);
    }

  /**
   * Send a newsletter based on the emailId and the contact group you want to sent it to.
   *
   * @param $eId
   * @param $contactGroupId
   * @param array $mailJobTags
   * @param array|bool $body
   * @return mixed
   */
    public function publishEmail($eId, $contactGroupId, $mailJobTags = array(),$body = false)
    {
        if ( $body ) {
            $body['contactGroupId'] = $contactGroupId;
            $body['newsletterId']   = $eId;

            if ( !isset($body['mailsPerHour'])) {
                $body['mailsPerHour'] = 10000;
            }

            if ( $mailJobTags ) {
                if ( isset($body['mailJobTagIds'])) {
                    $body['mailJobTagIds'] = array_unique(array_merge($body['mailJobTagIds'],$mailJobTags));
                } else {
                    $body['mailJobTagIds'] = $mailJobTags;
                }
            }
        } else {
            $body = array(
                'contactGroupId' => $contactGroupId,
                'newsletterId'	 => $eId,
                'mailsPerHour'	 => 10000,
                'mailJobTagIds'  => array(
                    'mailJobTagId' => $mailJobTags
                )
            );
        }

      return $this->invoke(__FUNCTION__,$body);
    }

  /**
   * Send a Direct mail to a contact group based on the direct mail id and the body
   *
   * @param $dmId
   * @param $contactGroupId
   * @param array $mailJobTags
   * @param array|bool $body
   * @return mixed
   */
    public function publishDirectEmail($dmId, $contactGroupId, $mailJobTags = array(), $body = false)
    {
        if ( $body ) {
            $body['contactGroupId'] = $contactGroupId;
            $body['directEmailId']  = $dmId;

            if ( !isset($body['mailsPerHour'])) {
                $body['mailsPerHour'] = 10000;
            }

            if ( $mailJobTags ) {
                if ( isset($body['mailJobTagIds'])) {
                    $body['mailJobTagIds'] = array_unique(array_merge($body['mailJobTagIds'],$mailJobTags));
                } else {
                    $body['mailJobTagIds'] = $mailJobTags;
                }
            }
        } else {
            $body = array(
                'contactGroupId' => $contactGroupId,
                'directEmailId'  => $dmId,
                'mailsPerHour'   => 10000,
                'mailJobTagIds'  => array(
                    'mailJobTagId' => $mailJobTags
                )
            );
        }

        return $this->invoke('publishEmail',$body);
    }
}