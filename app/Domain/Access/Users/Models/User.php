<?php

namespace App\Domain\Access\Users\Models;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @ORM\Column(type="string")
     */
    public $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;


    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @ORM\NamedQuery(name="User.findByName", query="SELECT u FROM App\Entities\User u WHERE u.name = :name")
     */
    public static function getRepository(EntityManagerInterface $em)
    {
        return $em->getRepository(User::class);
    }

}
