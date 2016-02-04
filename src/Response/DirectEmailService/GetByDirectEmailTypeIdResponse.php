<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace HarperJones\Tripolis\Response\DirectEmailService;


use HarperJones\Tripolis\Response\AbstractIteratorResponse;

class GetByDirectEmailTypeIdResponse extends AbstractIteratorResponse
{

    public function parseResponse($reply)
    {
        $this->populate($reply,'directEmails','directEmail');
    }
}