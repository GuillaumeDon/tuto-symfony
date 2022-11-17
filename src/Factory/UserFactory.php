<?php

namespace App\Factory;

use App\Entity\User;
use DateTimeImmutable;
use Zenstruck\Foundry\Proxy;
use App\Repository\UserRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\RepositoryProxy;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @extends ModelFactory<User>
 *
 * @method static User|Proxy createOne(array $attributes = [])
 * @method static User[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static User[]|Proxy[] createSequence(array|callable $sequence)
 * @method static User|Proxy find(object|array|mixed $criteria)
 * @method static User|Proxy findOrCreate(array $attributes)
 * @method static User|Proxy first(string $sortedField = 'id')
 * @method static User|Proxy last(string $sortedField = 'id')
 * @method static User|Proxy random(array $attributes = [])
 * @method static User|Proxy randomOrCreate(array $attributes = [])
 * @method static User[]|Proxy[] all()
 * @method static User[]|Proxy[] findBy(array $attributes)
 * @method static User[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static User[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method User|Proxy create(array|callable $attributes = [])
 */
final class UserFactory extends ModelFactory
{
    public function __construct(
        private UserPasswordHasherInterface $hasher)
    
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
       $datetime = self::faker()->dateTimeBetween('-3 years', 'now', 'Europe/Paris');
       $datetimeImmutable = DateTimeImmutable::createFromMutable($datetime);
    
       return [
           'firstname' => self::faker()->firstName,
           'lastname' => self::faker()->lastName,
           'email' => self::faker()->email,
           'hash' => 'password',
           'createdAt' => $datetimeImmutable,
       ];
    }
    

    protected function initialize(): self
    {
        return $this
        ->afterInstantiate(function(User $user) {
            // Password hash
            $plainPassword = $user->getHash();
            $hashedPassword = $this->hasher->hashPassword($user, $plainPassword);
            $user->setHash($hashedPassword);
        });
    }

    protected static function getClass(): string
    {
        return User::class;
    }

    
}
