<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Training", inversedBy="lessons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $training;

    private $registrations;

    private $lesson_id;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
        $this->lesson_id = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }



    public function getTraining(): ?Training
    {
        return $this->training;
    }

    public function setTraining(?Training $training): self
    {
        $this->training = $training;

        return $this;
    }

    /**
     * @return Collection|Registration[]
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): self
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations[] = $registration;
            $registration->setRegistrationId($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): self
    {
        if ($this->registrations->contains($registration)) {
            $this->registrations->removeElement($registration);
            // set the owning side to null (unless already changed)
            if ($registration->getRegistrationId() === $this) {
                $registration->setRegistrationId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Registration[]
     */
    public function getLessonId(): Collection
    {
        return $this->lesson_id;
    }

    public function addLessonId(Registration $lessonId): self
    {
        if (!$this->lesson_id->contains($lessonId)) {
            $this->lesson_id[] = $lessonId;
            $lessonId->setRegistrationId($this);
        }

        return $this;
    }

    public function removeLessonId(Registration $lessonId): self
    {
        if ($this->lesson_id->contains($lessonId)) {
            $this->lesson_id->removeElement($lessonId);
            // set the owning side to null (unless already changed)
            if ($lessonId->getRegistrationId() === $this) {
                $lessonId->setRegistrationId(null);
            }
        }

        return $this;
    }
}
