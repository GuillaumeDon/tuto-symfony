<?php

namespace App\Factory;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Comment>
 *
 * @method static Comment|Proxy createOne(array $attributes = [])
 * @method static Comment[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Comment[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Comment|Proxy find(object|array|mixed $criteria)
 * @method static Comment|Proxy findOrCreate(array $attributes)
 * @method static Comment|Proxy first(string $sortedField = 'id')
 * @method static Comment|Proxy last(string $sortedField = 'id')
 * @method static Comment|Proxy random(array $attributes = [])
 * @method static Comment|Proxy randomOrCreate(array $attributes = [])
 * @method static Comment[]|Proxy[] all()
 * @method static Comment[]|Proxy[] findBy(array $attributes)
 * @method static Comment[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Comment[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static CommentRepository|RepositoryProxy repository()
 * @method Comment|Proxy create(array|callable $attributes = [])
 */
final class CommentFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
       return [
           'user' => UserFactory::random(),
           'content' => self::faker()->text(250),
           'createdAt' => self::faker()->dateTimeBetween('-3 years', 'now', 'Europe/Paris'),
           'post' => PostFactory::random()
       ];
    }
    

    protected function initialize(): self
    {
       return $this
       ->afterInstantiate(function(Comment $comment) {
           $postCreatedAt = $comment->getPost()->getCreatedAt();
           $commentCreatedAt = \DateTimeImmutable::createFromMutable(self::faker()->dateTimeBetween($postCreatedAt->format('Y-m-d')));
           $comment->setCreatedAt($commentCreatedAt);
       });
    }
    

    protected static function getClass(): string
    {
        return Comment::class;
    }
}
