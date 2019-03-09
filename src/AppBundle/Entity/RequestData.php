<?php
/**
 * Created by PhpStorm.
 * User: glenn
 * Date: 12.05.15
 * Time: 15:32.
 */

namespace AppBundle\Entity;


class RequestData
{

    protected $username;
    protected $repoType;


    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getRepoType()
    {
        return $this->repoType;
    }

    public function setRepoType($repoType)
    {
        $this->repoType = $repoType;

        return $this;
    }

}
