<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace HarperJones\Tripolis\Response\WorkspaceService;


use HarperJones\Tripolis\Response\AbstractIteratorResponse;

class GetByContactDatabaseIdResponse extends AbstractIteratorResponse
{
    public function parseResponse($reply)
    {
        $this->populate($reply,'workspaces','workspace');
    }
}