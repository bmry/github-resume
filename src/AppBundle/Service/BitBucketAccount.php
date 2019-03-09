<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/7/2019
 * Time: 10:44 PM
 */

namespace AppBundle\Service;


use Doctrine\Common\Collections\ArrayCollection;

class BitBucketAccount implements SourceRepoAccountInterface
{
    private $repositories;

    public function __construct()
    {
        $this->repositories = new ArrayCollection();
    }


    public function getOwner()
    {
        // TODO: Implement getUser() method.
    }

    public function getAvatarUrl()
    {
        // TODO: Implement getAvatarUrl() method.
    }

    public function createUserRepoAccountObject($username)
    {
        // TODO: Implement createUserRepoAccountObject() method.
    }

    public function getRepositories()
    {
        // TODO: Implement getRepositories() method.
    }

    public function getLanguageUsedPercentage()
    {
        // TODO: Implement getLanguageUsedPercentage() method.
    }


    private function calculateLanguagePercentage(){

    }

    public function usernameExist()
    {
        // TODO: Implement usernameExist() method.
    }


}