<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/7/2019
 * Time: 5:37 PM
 */

namespace AppBundle\Service;


interface SourceRepoAccountInterface
{
    public function getOwner();

    public function getRepositories();

    public function getLanguageUsedPercentage();

    public function getAvatarUrl();

    public function createUserRepoAccountObject($username);

}