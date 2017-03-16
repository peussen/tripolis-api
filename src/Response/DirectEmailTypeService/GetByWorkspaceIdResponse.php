<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace MartyBel\Tripolis\Response\DirectEmailTypeService;


use MartyBel\Tripolis\Response\AbstractIteratorResponse;

class GetByWorkspaceIdResponse extends AbstractIteratorResponse
{
    public function parseResponse($reply)
    {
        $this->populate($reply,'directEmailTypes','directEmailType');
    }
}