<?php

namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GescomBundle\Entity\User;

use GescomBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\SecurityBundle\Tests\Functional\Bundle\CsrfFormLoginBundle\Form\UserLoginType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class LoadUserData
 * @package GescomBundle\DataFixtures\ORM
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {
        /**
         * Admin Area
         */
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setPassword(password_hash("admin", PASSWORD_BCRYPT));
        $admin->setSalt('');
        $admin->setRoles(array('ROLE_ADMIN'));
        $em->persist($admin);

        /**
         * Moderator Area
         */
        $moderator = new User();
        $moderator->setUsername('moderator');
        $moderator->setPassword(password_hash("moderator", PASSWORD_BCRYPT));
        $moderator->setSalt('');
        $moderator->setRoles(array('ROLE_MODERATOR'));
        $em->persist($moderator);

        /**
         * Vendor Area
         */
        $vendor = new User();
        $vendor->setUsername('vendor');
        $vendor->setPassword(password_hash("vendor", PASSWORD_BCRYPT));
        $vendor->setSalt('');
        $vendor->setRoles(array('ROLE_VENDOR'));
        $em->persist($vendor);

        /**
         * User Area
         */
        $user = new User();
        $user->setUsername('user');
        $user->setPassword(password_hash("user", PASSWORD_BCRYPT));
        $user->setSalt('');
        $user->setRoles(array('ROLE_USER'));
        $em->persist($user);

        /**
         * Save Generates
         */
        $em->flush();
    }
    public function getOrder()
    {
        return 5;
    }
}