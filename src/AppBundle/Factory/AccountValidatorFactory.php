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
    public static function buildAccountValidator($repositoryType){

        $className = 'AppBundle\Validation\\'.$repositoryType.'AccountValidator';

        if(class_exists($className)){
            return new $className;
        }

    }
}