<?php
/**
 * Created by PhpStorm.
 * User: glenn
 * Date: 09.07.15
 * Time: 13:52.
 */

namespace AppBundle\Validaton\Constraints;

use AppBundle\Factory\AccountValidatorFactory;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Rombit\LeanX\AppBundle\Entity\RequestData;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class RepoAccountValidator extends ConstraintValidator
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($object, Constraint $constraint)
    {
        if (!$object instanceof RequestData) {
            return;
        }

        $repositoryType = $object->getRepoType();
        $accountUserName = $object->getUsername();
        $accountValidator = AccountValidatorFactory::buildAccountValidator($repositoryType);

        if (!$accountValidator->accountExist($accountUserName)) {
            $this->context->buildViolation(
                'account.not_found',
                []
            )->addViolation();
        }
    }

}
