<?php

namespace GescomBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use GescomBundle\Entity\User;

use GescomBundle\Entity\UserProfile;
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
     * General var
     * Set nb rolesUsers needed
     */
    private $nbAdmin        = 1;
    private $nbModerator    = 4;
    private $nbVendor       = 10;
    private $nbUser         = 20;

    /**
     * @param ObjectManager $em
     */
    public function load(ObjectManager $em)
    {
        /**
         * Admin Area
         */
        for ($i=1; $i <= $this->nbAdmin; ++$i){
            $admin = new User();
            $admin->setEmail('admin'.$i.'@test.fr');
            $admin->setPassword(password_hash("admin", PASSWORD_BCRYPT));
            $admin->setSalt('');
            $admin->setRoles(array('ROLE_ADMIN'));
            $profile = $this->getUserProfile($admin);
            $admin->setProfile($profile);

            $em->persist($profile);
            $em->persist($admin);
        }

        /**
         * Moderator Area
         */
        for ($i=1; $i <= $this->nbModerator; ++$i) {
            $moderator = new User();
            $moderator->setEmail('moderator'.$i.'@test.fr');
            $moderator->setPassword(password_hash("moderator", PASSWORD_BCRYPT));
            $moderator->setSalt('');
            $moderator->setRoles(array('ROLE_MODERATOR'));
            $profile = $this->getUserProfile($moderator);
            $moderator->setProfile($profile);

            $em->persist($profile);
            $em->persist($moderator);
        }

        /**
         * Vendor Area
         */
        for ($i=1; $i <= $this->nbVendor; ++$i) {
            $vendor = new User();
            $vendor->setEmail('vendor'.$i.'@test.fr');
            $vendor->setPassword(password_hash("vendor", PASSWORD_BCRYPT));
            $vendor->setSalt('');
            $vendor->setRoles(array('ROLE_VENDOR'));
            $profile = $this->getUserProfile($vendor);
            $vendor->setProfile($profile);

            $em->persist($profile);
            $em->persist($vendor);
        }

        /**
         * User Area
         */
        for ($i=1; $i <= $this->nbUser; ++$i) {
            $user = new User();
            $user->setEmail('user'.$i.'@test.fr');
            $user->setPassword(password_hash("user", PASSWORD_BCRYPT));
            $user->setSalt('');
            $user->setRoles(array('ROLE_USER'));
            $profile = $this->getUserProfile($user);
            $user->setProfile($profile);

            $em->persist($profile);
            $em->persist($user);
        }

        /**
         * Save Generates
         */
        $em->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 6;
    }

    /**
     * Kept profile by email
     * and set a fixed avatar
     *
     * @param User $user
     * @return UserProfile
     */
    private function getUserProfile(User $user)
    {
        $profile = new UserProfile();
        $profile->setUsername(str_replace('@test.fr', '', $user->getEmail()));
        $profile->setAvatar('assets/img/avatar.png');
        $profile->setUser($user);

        return $profile;
    }

}