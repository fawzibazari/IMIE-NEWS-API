<?php
namespace App\Service;

use ApiPlatform\GraphQl\Resolver\MutationResolverInterface;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthMutator implements MutationResolverInterface
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordEncoder,
        private JWTTokenManagerInterface $JWTManager,
        private EntityManagerInterface $em,
    )
    {

    }

    public function __invoke($item, array $context)
    {
        if ($context["info"]->fieldName == 'loginUser') {
            $userRepository = $this->em->getRepository("App:User");
            $user = $userRepository->findOneBy(['email' => $item->getEmail()]);
            if ($this->userPasswordEncoder->isPasswordValid($user, $item->getPlainPassword())) {
                $token = $this->JWTManager->create($item);
                $user->setToken($token);
            }
            return $user;
        }
    }
}