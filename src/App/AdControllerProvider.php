<?php
namespace App;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
/**
 * Components
 **/
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AdControllerProvider implements ControllerProviderInterface
{
    /**
     * Connect function is used by Silex to mount the controller to the application.
     *
     * Please list all routes inside here.
     *
     * @param Application $app Silex Application Object.
     *
     * @return Response Silex Response Object.
     */
    public function connect(Application $app)
    {   
        /**
         * Here we may add a middleware to Authorize API clients
         **/
        $app->before(function (Request $request, Application $app) {
            /**
             * import middleware
             * return 401 if unauthorized
             **/
        });

        /**
         * Standardization of Request format (Form vs JSON)
         **/
        $app->before(function (Request $request, Application $app) {
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : array());
            }
        });

        /**
         * @var \Silex\ControllerCollection $controllers
         */
        $controllers = $app['controllers_factory'];
        /**
         * Listing my API routes
         **/
        $controllers->get('/','App\AdControllerProvider::index');
        $controllers->post('/','App\AdControllerProvider::create');

        return $controllers;
    }

    /**
     * Get all the ads.
     *
     * @param Request $request
     *
     * @return string
     */
    public function index() {
        return 'List all the ads';
    }

    /**
     * Create new ad.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request) {
        $user = $request->get('utilisateur');
        $category = $request->get('categorie');
        $title = $request->get('titre');
        $content = $request->get('contenu');
        $price = $request->get('prix');

        $responseRequest = $request->request->all();

        if(!$user || !$category || !$title || !$content || !$price) {
            $response = [
                            'message' => 'Il manque des paramètres',
                            'request' => [
                                $responseRequest,
                            ]
                        ];
            return new Response(json_encode($response), 400);   
        }else{
            # DO ADD TO DATABASE
            $response = [
                            'message' => 'Annonce correctement ajoutée',
                            'request' => [
                                $responseRequest,
                            ]
                        ];
            return new Response(json_encode($response), 200);   
        }
    }
}