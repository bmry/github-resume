<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/9/2019
 * Time: 11:21 AM
 */

namespace AppBundle\Validation;


use AppBundle\Service\SourceRepoAccountInterface;

interface AccountValidatorInterface
{
    function accountExist($accountUserName);
}