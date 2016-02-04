<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace HarperJones\Tripolis\Response\DirectEmailTypeService;


use HarperJones\Tripolis\Response\AbstractIteratorResponse;

class GetByWorkspaceIdResponse extends AbstractIteratorResponse
{
    public function parseResponse($reply)
    {
        $this->populate($reply,'directEmailTypes','directEmailType');
    }
}