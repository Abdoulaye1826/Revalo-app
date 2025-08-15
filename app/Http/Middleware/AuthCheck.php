<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheck
{
    /**
     * Liste des acc�s autoris�s selon le type d'utilisateur
     */
    protected array $accessMap = [
        // achéteur (type 3), entreprise (2), Admin (1)
        'dossiers' => [1, 2, 3],
        // ajouter d'autres routes ici...
    ];

    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // 1. Non connect� ? redirection vers login
        if (!$user && !$request->is('login')) {
            return redirect()->route('login')->with('error', 'Vous devez vous authentifier !');
        }

        // 2. Connect� mais sur la page login ? redirection vers la page d�accueil selon type
        if ($user && $request->is('login')) {
            return match ($user->type) {
                1 => redirect('/dossiers/administrateur'),
                2 => redirect('/dossiers/entreprise'),
                2 => redirect('/dossiers/acheteur'),
                default => redirect('/'),
            };
        }

        // 3. V�rification des droits d'acc�s
        if ($user) {
            $path = $request->path(); // Ex: dossiers/create
            $routeKey = $this->getRouteKey($path);

            if (array_key_exists($routeKey, $this->accessMap)) {
                if (!in_array($user->type, $this->accessMap[$routeKey])) {
                    abort(403, "Acc�s refus� : vous n�avez pas les droits pour cette ressource.");
                }
            }
        }

        return $next($request)
            ->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }

    /**
     * Retourne une version normalis�e de la route pour la correspondance dans accessMap.
     */
    private function getRouteKey(string $path): string
    {
        $segments = explode('/', $path);
        return count($segments) > 1 ? "{$segments[0]}/{$segments[1]}" : $segments[0];
    }

    private function VerifyAccessToUser($route, $user_type, $request)
    {

        /* 1 = admin ; 2 = entreprise ; 3 = acheteur */
        $type_List = array(1, 2, 3); //A récupérer niveau de la BD
        $path_List_Access_Users = array(

            //Ressources du profil secrétaire
            'accueil' => array(1, 2, 3),
            'dossiers' => array(1, 2),
            'dossiers/create' => array(1, 2),
            'dossiers/indexParent' => array(1, 2),
            'dossiers/save' => array(1, 2),
        );



        //formatage de la route
        $routeExplode = explode('/', $route);
        if (count($routeExplode) > 2) {
            $route = $routeExplode[0] . '/' . $routeExplode[1];
        }

        //Verifications des accès à l'utilisateur
        if (in_array($user_type, $type_List)) {
            if (array_key_exists($route, $path_List_Access_Users)) {
                if (in_array($user_type, $path_List_Access_Users[$route])) {
                    return true;
                } else {

                    $url = $request->url();
                    $path = $request->path();
                    $href = str_replace($path, 'auth/login', $url);

                    echo ("<span style='color: black; font-size: 20px;'> Vous n'avez pas accès à cette ressource => <a href='" . $href . "'>Cliquez !</a></span>");
                    exit();
                }
            } else {
                echo ("<span style='color: black; font-size: 20px;'> Cette ressource n'est pas définie </span>");
                exit();
            }
        } else {
            echo ("<span style='color: black; font-size: 20px;'> Cet utilisateur (n'existe pas) n'a pas accès à cette ressource </span>");
            exit();
        }
    }
}