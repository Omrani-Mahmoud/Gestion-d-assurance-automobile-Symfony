<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as FosUser;


/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="INDEX_Reference_type", columns={"type"})})
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\InheritanceType(value="SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"admin"="Admin", "agent"="Agent", "assure"="Assure", "compagnie"="Compagnie", "courtier"="Courtier", "expert"="Expert"})
 */
abstract class User extends FosUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct($username,$email,$role)
    {
        parent::__construct();
        $this->username = $username;
        $this->email = $email;
        $this->addRole($role);
    }

    public function fromClass($c)
    {
        $this->usernameCanonical=$c->usernameCanonical;
        $this->emailCanonical=$c->emailCanonical;
        $this->enabled=$c->enabled;
        $this->salt=$c->salt;
        $this->password=$c->password;
        $this->lastLogin=$c->lastLogin;
        $this->confirmationToken=$c->confirmationToken;
        $this->passwordRequestedAt=$c->passwordRequestedAt;
    }
}

