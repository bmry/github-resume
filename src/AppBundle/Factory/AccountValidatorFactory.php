<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/9/2019
 * Time: 3:44 PM
 */

namespace AppBundle\Factory;


class AccountValidatorFactory
{
    public static function buildAccountValidator($repositoryName){

        $className = $repositoryName.'Validator()';
        if(class_exists($className)){
            return new $repositoryName.'Validator()';
        }
    }
}