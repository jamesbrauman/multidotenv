<?php namespace TheSnackalicious\MultiDotEnv;

use Dotenv;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Bootstrap\DetectEnvironment as BaseDetectEnvironment;

class DetectEnvironment extends BaseDetectEnvironment {

    /**
     * Bootstrap the given application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function bootstrap(Application $app)
    {
        parent::bootstrap($app);

        $envFile = '.env.' . $app->environment();

        if (file_exists($app->basePath() . DIRECTORY_SEPARATOR . $envFile))
            Dotenv::load($app->basePath(), $envFile);
    }
}
