<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/7/2019
 * Time: 5:47 PM
 */

namespace AppBundle\Factory;


use AppBundle\Service\GitHubAccount;

class RepositoryAccountFactory
{

    public static function buildRepository($repositoryType, $accountName){

        $className = 'AppBundle\Service\\'.$repositoryType.'Account';

        if(class_exists($className)){
            return new $className($accountName);
        }

    }

}