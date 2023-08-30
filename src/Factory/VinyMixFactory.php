<?php

namespace App\Factory;

use App\Entity\VinyMix;
use App\Repository\VinyMixRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<VinyMix>
 *
 * @method        VinyMix|Proxy                     create(array|callable $attributes = [])
 * @method static VinyMix|Proxy                     createOne(array $attributes = [])
 * @method static VinyMix|Proxy                     find(object|array|mixed $criteria)
 * @method static VinyMix|Proxy                     findOrCreate(array $attributes)
 * @method static VinyMix|Proxy                     first(string $sortedField = 'id')
 * @method static VinyMix|Proxy                     last(string $sortedField = 'id')
 * @method static VinyMix|Proxy                     random(array $attributes = [])
 * @method static VinyMix|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VinyMixRepository|RepositoryProxy repository()
 * @method static VinyMix[]|Proxy[]                 all()
 * @method static VinyMix[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static VinyMix[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static VinyMix[]|Proxy[]                 findBy(array $attributes)
 * @method static VinyMix[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static VinyMix[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VinyMixFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'genre' => self::faker()->randomElement(['pop','rock','Heavy metal']),
            'title' => self::faker()->words(5,true),// true to return a string otherwise it returns an array
            'Description'=>self::faker()->paragraph(),
            'trackCount' => self::faker()->numberBetween(5,20),
            'votes' => self::faker()->NumberBetween(-50,50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(VinyMix $vinyMix): void {})
        ;
    }

    protected static function getClass(): string
    {
        return VinyMix::class;
    }
}
