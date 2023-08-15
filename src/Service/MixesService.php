<?php
namespace App\Service;
use Psr\Cache\CacheItemInterface;
use Symfony\Bridge\Twig\Command\DebugCommand;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class  MixesService {
    //when adding private/public/.. $Argname in the construct it creates and initialate  the arg for the class
    //about isdebug check config/services.yaml
    //                   githubContentClient check framework.yaml Fetching the Named Version of a Service
    public function __construct(
        private HttpClientInterface $githubContentClient,
        private CacheInterface $cache,
        #[Autowire('%kernel.debug%')]
        private bool $isDebug,
        //autowire non autowireable services
        #[Autowire(service:'twig.command.debug')]
        private DebugCommand $twigDebugCommand,
    ){
    }
    public function getAll()
    {
        return $this->cache->get('mixes_data', function (CacheItemInterface $cacheItem)  {
            $cacheItem->expiresAfter($this->isDebug ? 5 : 60);
            $response = $this->githubContentClient->request('GET', '/SymfonyCasts/vinyl-mixes/main/mixes.json', [
                'headers' => [
                    'Authorization' => 'Token ghp_foo_bar',
                ]]);
            return $response->toArray();
        });
    }
}
