<?php

declare(strict_types=1);

/*
 * This file is part of the Doctrine Behavioral Extensions package.
 * (c) Gediminas Morkevicius <gediminas.morkevicius@gmail.com> http://www.gediminasm.org
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gedmo\Tests\Sortable\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
#[ORM\Entity]
class Paper
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    /**
     * @ORM\Column(name="name", type="string")
     */
    #[ORM\Column(name: 'name', type: Types::STRING)]
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Author", mappedBy="paper", cascade={"persist", "remove"})
     */
    #[ORM\OneToMany(mappedBy: 'paper', targetEntity: Author::class, cascade: ['persist', 'remove'])]
    private $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getAuthors(): ArrayCollection
    {
        return $this->authors;
    }

    public function addAuthor($author): void
    {
        $this->authors->add($author);
    }
}
