<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Assert\Email(message="L'email {{ value }}) n'est pas valide.")
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     * @var string
     * @Assert\NotBlank(message="Ce champs ne peut pas être vide.")
     * @Assert\Length(min="25", minMessage="Votre message doit contenir au minimum {{ limit }} caractères.")
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
