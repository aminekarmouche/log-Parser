<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entry
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\EntryRepository")
 */
class Entry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="client", type="string", length=100)
     */
    private $client;

    /**
     * @var string
     *
     * @ORM\Column(name="userid", type="string", length=100)
     */
    private $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="clientid", type="string", length=100)
     */
    private $clientid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timed", type="datetime")
     */
    private $timed;

    /**
     * @var string
     *
     * @ORM\Column(name="method", type="string", length=10)
     */
    private $method;

    /**
     * @var string
     *
     * @ORM\Column(name="request", type="string", length=100)
     */
    private $request;

    /**
     * @var integer
     *
     * @ORM\Column(name="status_code", type="smallint")
     */
    private $statusCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer")
     */
    private $size;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set client
     *
     * @param string $client
     * @return Entry
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return string 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set userid
     *
     * @param string $userid
     * @return Entry
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return string 
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set clientid
     *
     * @param string $clientid
     * @return Entry
     */
    public function setClientid($clientid)
    {
        $this->clientid = $clientid;

        return $this;
    }

    /**
     * Get clientid
     *
     * @return string 
     */
    public function getClientid()
    {
        return $this->clientid;
    }

    /**
     * Set timed
     *
     * @param \DateTime $timed
     * @return Entry
     */
    public function setTimed($timed)
    {
        $this->timed = $timed;

        return $this;
    }

    /**
     * Get timed
     *
     * @return \DateTime 
     */
    public function getTimed()
    {
        return $this->timed;
    }

    /**
     * Set method
     *
     * @param string $method
     * @return Entry
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string 
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set request
     *
     * @param string $request
     * @return Entry
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get request
     *
     * @return string 
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set statusCode
     *
     * @param integer $statusCode
     * @return Entry
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get statusCode
     *
     * @return integer 
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set size
     *
     * @param integer $size
     * @return Entry
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer 
     */
    public function getSize()
    {
        return $this->size;
    }
}
