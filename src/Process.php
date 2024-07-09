<?php

namespace RabbitLoader\Laravel;

use Closure;
use RabbitLoader\SDK as SDK;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class Process
{
    private static $isActive;
    private $rlSDK = null;

    function __construct()
    {
        $licenseKey = config('rabbitloader.licenseKey', '');
        $cacheDir = config('rabbitloader.cacheDir', '');
        $skipPaths = config('rabbitloader.skipPaths', []);
        $skipCookies = config('rabbitloader.skipCookies', []);
        $ignoreParams = config('rabbitloader.ignoreParams', []);
        $meMode = config('rabbitloader.meMode', false);

        $this->rlSDK = new SDK\RabbitLoader($licenseKey, $cacheDir);

        $this->rlSDK->skipForPaths($skipPaths);

        $this->rlSDK->skipForCookies($skipCookies);

        $this->rlSDK->ignoreParams($ignoreParams);

        if ($meMode) {
            $this->rlSDK->setMeMode();
        }

        $this->rlSDK->setPlatform([
            'plugin_cms' => 'laravel',
            'plugin_v' => '1.2.0',
            'cms_v' => App::version()
        ]);

        $this->rlSDK->setDebug(config('rabbitloader.debugMode', false));
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return \Illuminate\Http\Response $response
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (!$this->isActive()) {
            return $response;
        }

        $html = $response->getContent();
        $this->setCanonical($html);

        $this->rlSDK->process();

        return $response->setContent($html);
    }

    /**
     * isActive - checks if the RL package is active
     * @return bool
     */
    protected function isActive()
    {
        if (!is_null(static::$isActive)) {
            return static::$isActive;
        }

        static::$isActive = (bool) config('rabbitloader.active', true);

        return static::$isActive;
    }

    /**
     * setCanonical - adds a meta tag with canonical URL
     * @return bool
     */
    private function setCanonical(&$html)
    {
        $canURL = URL::current();
        if (!empty($canURL)) {
            $metaTag = "<meta name='rl:url' content='$canURL'>";
            $html = str_ireplace('</head>', $metaTag . '</head>', $html, $replaced);
        }
    }
}
