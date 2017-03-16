<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace MartyBel\Tripolis\Response\WorkspaceService;


use MartyBel\Tripolis\Response\AbstractIteratorResponse;

class GetByContactDatabaseIdResponse extends AbstractIteratorResponse
{
    public function parseResponse($reply)
    {
        $this->populate($reply,'workspaces','workspace');
    }
}