<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/7/2019
 * Time: 5:45 PM
 */

namespace AppBundle\Controller;

use AppBundle\Factory\RepositoryAccountFactory;
use AppBundle\Form\RequestFormType;
use AppBundle\Traits\GitHubTraits;
use AppBundle\Entity\RequestData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ResumeController extends Controller
{
    use GitHubTraits;

    public function generateResumeAction(Request $request)
    {
        $requestData = new RequestData();

        $form = $this->createForm(new RequestFormType(), $requestData);
        $form->handleRequest($request);
        $accountUserName = $requestData->getUserName();
        $repositoryType = $requestData->getRepoType();

        if ($form->isSubmitted() && $form->isValid()) {

            $repositoryAccount = RepositoryAccountFactory::buildRepository($repositoryType, $accountUserName);
            $resumeData = [
                'owner' => $repositoryAccount->getOwner(),
                'website' => $repositoryAccount->getWebsite(),
                'avatarUrl' => $repositoryAccount->getAvatarUrl(),
                'repoType' => $repositoryType,
                'totalRepo' => $repositoryAccount->getTotalRepo(),
                'accountUsername' => $accountUserName

            ];

            return $this->render('AppBundle:Resume:resume.html.twig',array('resumeData' => $resumeData));
        }

        return $this->render('AppBundle:Resume:search.html.twig',array('form' => $form->createView()));
    }


    public function repositoryAction(Request $request){
        $repositoryType = $request->query->get('repo_type');
        $accountUserName = $request->query->get('username');
        $repositoryAccount = RepositoryAccountFactory::buildRepository($repositoryType, $accountUserName);
        $repositories = $repositoryAccount->getRepositories();
        $percentageOfLanguagesUsed = $repositoryAccount->getPercentageOfLanguageUsed();
        return $this->render('AppBundle:Resume:repositories.html.twig',array('repositories' => $repositories, 'percentageOfLanguagesUsed'=> $percentageOfLanguagesUsed));


    }

}