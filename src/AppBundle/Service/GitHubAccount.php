<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/7/2019
 * Time: 5:43 PM
 */

namespace AppBundle\Service;


use AppBundle\Traits\GitHubTraits;
use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Exception\ClientException;

class GitHubAccount implements SourceRepoAccountInterface
{
    private $repositories;
    private $repositoryLink;
    private $avatarUrl;
    private $numberOfPublicRepository;
    private $owner;

    use GitHubTraits;

    public function __construct()
    {
        $this->repositories = new ArrayCollection();
    }


    public function getOwner()
    {
        return $this->owner;
    }

    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }
    public function getRepositories()
    {
        return $this->repositories;
    }

    public function getLanguageUsedPercentage()
    {
        // TODO: Implement getLanguageUsedPercentage() method.
    }

    private function createRepositoryList($accountUserName)
    {
        $content  = $this->getRepositoryFromGitHubByUserName($accountUserName);
        $repos = json_decode($content);

        foreach ($repos as $repo){
            $repoObject = new \stdClass();
            $repoObject->repoLink = $repo['html_url'];
            $repoObject->repoName = $repo['name'];
            $repoObject->repoDescription = $repo['description'];
            $this->repositories->add($repoObject);
        }
    }

    public function createUserRepoAccountObject($accountUserName)
    {
        $accountOwnerDetails =  $this->getOwnerFromGitHubByUserName($this->owner);
        $accountOwnerDetails = json_decode($accountOwnerDetails);
        $this->repositoryLink = $accountOwnerDetails['repos_url'];
        $this->numberOfPublicRepository = $accountOwnerDetails['repos_url'];
        $this->avatarUrl = $accountOwnerDetails['avatar_url'];
        $this->createRepositoryList($accountUserName);

        return $this;
    }
}