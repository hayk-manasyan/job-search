<?php

namespace Jobs\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a single post in a blog.
 * @ORM\Entity
 * @ORM\Table(name="jobs")
 */
class Jobs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;
    /**
     * @ORM\Column(name="external_id")
     */
    protected $externalId;
    /**
     * @ORM\Column(name="title")
     */
    protected $title;
    /**
     * @ORM\Column(name="location")
     */
    protected $location;
    /**
     * @ORM\Column(name="type")
     */
    protected $type;
    /**
     * @ORM\Column(name="description")
     */
    protected $description;
    /**
     * @ORM\Column(name="how_to_apply")
     */
    protected $howToApply;
    /**
     * @ORM\Column(name="company")
     */
    protected $company;
    /**
     * @ORM\Column(name="company_url")
     */
    protected $companyUrl;
    /**
     * @ORM\Column(name="company_logo")
     */
    protected $companyLogo;
    /**
     * @ORM\Column(name="job_url")
     */
    protected $jobUrl;
    /**
     * @ORM\Column(name="created_at")
     */
    protected $createdAt;
    /**
     * @ORM\Column(name="created_at_external")
     */
    protected $createdAtExternal;
    /**
     * @ORM\Column(name="job_source")
     */
    protected $source;
    /**
     * @ORM\Column(name="tag")
     */
    protected $tag;



    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Jobs
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param mixed $externalId
     * @return Jobs
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Jobs
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return Jobs
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Jobs
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Jobs
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHowToApply()
    {
        return $this->howToApply;
    }

    /**
     * @param mixed $howToApply
     * @return Jobs
     */
    public function setHowToApply($howToApply)
    {
        $this->howToApply = $howToApply;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     * @return Jobs
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompanyUrl()
    {
        return $this->companyUrl;
    }

    /**
     * @param mixed $companyUrl
     * @return Jobs
     */
    public function setCompanyUrl($companyUrl)
    {
        $this->companyUrl = $companyUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompanyLogo()
    {
        return $this->companyLogo;
    }

    /**
     * @param mixed $companyLogo
     * @return Jobs
     */
    public function setCompanyLogo($companyLogo)
    {
        $this->companyLogo = $companyLogo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJobUrl()
    {
        return $this->jobUrl;
    }

    /**
     * @param mixed $jobUrl
     * @return Jobs
     */
    public function setJobUrl($jobUrl)
    {
        $this->jobUrl = $jobUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return Jobs
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAtExternal()
    {
        return $this->createdAtExternal;
    }

    /**
     * @param mixed $createdAtExternal
     * @return Jobs
     */
    public function setCreatedAtExternal($createdAtExternal)
    {
        $this->createdAtExternal = $createdAtExternal;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     * @return Jobs
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     * @return Jobs
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

}