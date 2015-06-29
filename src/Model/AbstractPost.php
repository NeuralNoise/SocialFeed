<?php

namespace Lns\SocialFeed\Model;

class AbstractPost implements PostInterface
{
    protected $identifier;
    protected $message;
    protected $author;
    protected $createdAt;

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(AuthorInterface $author)
    {
        $this->author = $author;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}