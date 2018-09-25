<?php
/**
 * Created by PhpStorm.
 * User: ANH
 * Date: 7/27/2017
 * Time: 10:31 AM
 */

namespace App\Providers;

use App\Services\Macros\Macros;
use Collective\Html\HtmlServiceProvider;


/**
 * Class MacroServiceProvider
 * @package App\Providers
 */
class MacroServiceProvider extends HtmlServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function registerFormBuilder()
    {
//        parent::registerFormBuilder();

        $this->app->singleton('form', function ($app) {
            $form = new Macros($app['html'], $app['url'], $app['view'],$app['session.store']->token());
            return $form->setSessionStore($app['session.store']);
        });

    }
}