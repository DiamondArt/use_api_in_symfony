<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
* @author Melissa Kouadio  <melissa.kouadio@veone.net>
*
* @ORM\Entity()
* @ORM\Table(name="`post`")
*/
class Post
{

/**
* @ORM\Id()
* @ORM\GeneratedValue()
*@ORM\Column(type="integer")
*@JMS\Expose()
*/
private $id;

/**
* @ORM\Column(name="title", type="string")
* @JMS\Expose()
* @var string
*/
private $title;


/**
* @ORM\Column(name="slug", type="string", nullable=true)
* @JMS\Expose()
* @JMS\Groups({"summary","detail"})
* @var string
*/
private $slug;

/**
 * @ORM\Column(name="content", type="text", nullable=true)
 * @JMS\Expose()
 * @JMS\Groups({"summary", "detail"})
 * @var string
 */
private $content;

/**
 * @ORM\Column(name="author", type="string", nullable=true)
 * @JMS\Expose()
 * @JMS\Groups({"summary", "detail"})
 * @var string
 */
private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }
}