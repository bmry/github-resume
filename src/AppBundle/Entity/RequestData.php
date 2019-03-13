<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/7/2019
 * Time: 5:45 PM
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
