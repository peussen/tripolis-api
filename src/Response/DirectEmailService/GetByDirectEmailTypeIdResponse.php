<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace MartyBel\Tripolis\Response\DirectEmailService;


use MartyBel\Tripolis\Response\AbstractIteratorResponse;

class GetByDirectEmailTypeIdResponse extends AbstractIteratorResponse
{

    public function parseResponse($reply)
    {
        $this->populate($reply,'directEmails','directEmail');
    }
}