<?php

declare(strict_types=1);

namespace App\Mailer;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

final class ContactMailer{

  private MailerInterface $mailer;
  private Environment $twig;
  private string $contactEmailAddress;

  public function __construct(MailerInterface $mailer, Environment $twig, string $contactEmailAddress){
    $this->mailer = $mailer;
    $this->twig = $twig;
    $this->contactEmailAddress = $contactEmailAddress;

  }

  public function send(){

    $email = (new Email())
    ->from('hello@example.com')
    ->to('contact@shoefony.com')
    ->subject('Un message random envoyé via Shoefony')
    ->html($this->twig->render('email/contact.html.twig', ['contact' => $this->contactEmailAddress]));

    $this->mailer->send($email);


  }

 

}

