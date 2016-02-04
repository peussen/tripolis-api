<?php
/*
 * @author: petereussen
 * @package: hj2016
 */

namespace HarperJones\Tripolis;

/**
 * Handles sending of a (transational) directmail to someone
 *
 * @package HarperJones\Tripolis
 */
class DirectMail
{
    static $mapping = false;

    /**
     * @var TripolisProvider
     */
    private $provider;

    /**
     * @var string
     */
    private $contactDatabaseId;

    /**
     * @var string
     */
    private $workspaceId;

    /**
     * Initialisation for sending transactional emails
     *
     * @param TripolisProvider $provider
     */
    public function __construct(TripolisProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Sets the selected database & selects the workspace that belongs with it
     * Currently this only supports the one workspace per database setup.
     *
     * @todo if someone has a multiple workspace per db setup, please help create a good setup
     * @param $id
     */
    public function db($id)
    {
        $this->contactDatabaseId = $id;

        $workspace         = $this->provider->workspace()->getByContactDatabaseId($id);
        $this->workspaceId = $workspace->first()->id;
    }

    /**
     * Sends a transational mail
     * You can use the direct mail ID or Name as argument. It will try to find out
     * which one it is by itself. So unless you use hashes as names, you should be okay
     *
     * @param string $dmId
     * @param string $contactId
     * @return bool
     */
    public function send($dmId,$contactId)
    {
        $publisher = $this->provider->publishing();

        try {
            $dm   = $this->provider->directEmail()->getById($dmId);
            $dmId = $dm->id;
        } catch( NotFoundException $e) {
            $dmId = $this->getByName($dmId);
        }

        try {
            $response  = $publisher->publishTransactionalEmail($contactId,$dmId);
            return $response->id;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Finds the directmail id based on the given name
     * Since there is no direct way of searching for direct mail templates based
     * on names, we need to create a mapping which maps all direct mails and their names.
     *
     * @param $name
     * @return bool
     */
    public function getByName($name)
    {
        if ( static::$mapping === false ) {
            $types = $this->provider->directEmailType()->getByWorkspaceId($this->workspaceId);
            $dmMap = array();

            foreach( $types as $type ) {
                $dms = $this->provider->directEmail()->getByDirectEmailTypeId($type->id);

                foreach( $dms as $dm ) {
                    $dmMap[strtolower($dm->name)] = $dm->id;
                }
            }

            static::$mapping = $dmMap;
        }

        $name = strtolower($name);

        if ( isset(static::$mapping[$name])) {
            return static::$mapping[$name];
        }
        return false;
    }
}