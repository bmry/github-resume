<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 2/13/2019
 * Time: 1:07 AM
 */

namespace AppBundle\Validaton\Constraints;


use Symfony\Component\Validator\Constraint;

class RepoAccount extends Constraint
{
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}

