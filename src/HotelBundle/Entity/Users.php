<?php

namespace HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=20, nullable=false)
     */
    private $lname;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=20, nullable=false)
     */
    private $sexe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="date", nullable=true)
     */
    private $lastLogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="password_request", type="integer", nullable=true)
     */
    private $passwordRequest;

    /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer", nullable=true)
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, nullable=false)
     */
    private $token;



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
     * Set name
     *
     * @param string $name
     *
     * @return Users
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lname
     *
     * @param string $lname
     *
     * @return Users
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Users
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     *
     * @return Users
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set passwordRequest
     *
     * @param integer $passwordRequest
     *
     * @return Users
     */
    public function setPasswordRequest($passwordRequest)
    {
        $this->passwordRequest = $passwordRequest;

        return $this;
    }

    /**
     * Get passwordRequest
     *
     * @return integer
     */
    public function getPasswordRequest()
    {
        return $this->passwordRequest;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     *
     * @return Users
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return Users
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}
