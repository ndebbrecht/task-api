<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TaskFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));
        $manager->persist($admin);
        $basicUser1 = new User();
        $basicUser1->setEmail('test1@example.com');
        $basicUser1->setRoles(['ROLE_USER']);
        $basicUser1->setPassword($this->passwordHasher->hashPassword($basicUser1, 'test1'));
        $manager->persist($basicUser1);
        $basicUser2 = new User();
        $basicUser2->setEmail('test2@example.com');
        $basicUser2->setRoles(['ROLE_USER']);
        $basicUser2->setPassword($this->passwordHasher->hashPassword($basicUser2, 'test2'));
        $manager->persist($basicUser2);

        $task1 = new Task();
        $task1->setName('Task 1');
        $task1->setAssignedTo($basicUser1);
        $task1->setStatus('new');
        $manager->persist($task1);
        $task2 = new Task();
        $task2->setName('Task 2');
        $task2->setAssignedTo($basicUser1);
        $task2->setStatus('in progress');
        $manager->persist($task2);
        $task3 = new Task();
        $task3->setName('Task 3');
        $task3->setAssignedTo($basicUser2);
        $task3->setStatus('done');
        $manager->persist($task3);
        $task4 = new Task();
        $task4->setName('Task 4');
        $task4->setAssignedTo($basicUser2);
        $task4->setStatus('new');
        $manager->persist($task4);

        $manager->flush();
    }
}
