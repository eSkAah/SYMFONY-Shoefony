<?php

namespace App\Event;

use App\Entity\Contact;

final class ContactCreated
{
    private  Contact $contact;


    public function __construct(contact $contact){
        $this->contact = $contact;
    }

    public function getContact(): Contact
    {
        return $this->contact;

    }
}