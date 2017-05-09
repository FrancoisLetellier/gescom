<?php

namespace GescomBundle\Form\User\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

class ChangePassword
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Votre mot de passe actuel n'est pas le bon"
     * )
     */
    protected $oldPassword;

    /**
     * @Assert\Length(
     *     min = 2,
     *     minMessage = "Votre mot de passe doit faire au moin 2 caractères"
     * )
     */
    protected $newPassword;

}