<?php

namespace App\Controllers;

use App\Models\PatientModel;
use CodeIgniter\Controller;
use League\OAuth2\Client\Provider\Facebook;

class AuthController extends Controller
{
    private $provider;

    public function __construct()
    {
        $this->provider = new Facebook([
            'clientId' => '1947757885733075',
            'clientSecret' => 'b803b98fbb26b8ee73c849eba1d07812',
            'redirectUri' => site_url('auth/facebookCallback'),
            'graphApiVersion' => 'v12.0',
        ]);
    }

    // Méthode pour l'inscription via Facebook
    public function facebookRegister()
    {
        // Redirige l'utilisateur vers Facebook pour l'inscription
        $authorizationUrl = $this->provider->getAuthorizationUrl();
        session()->set('oauth2state', $this->provider->getState());
        return redirect()->to($authorizationUrl);
    }

    // Méthode pour la connexion via Facebook
    public function facebookLogin()
    {
        // Redirige l'utilisateur vers Facebook pour la connexion
        $authorizationUrl = $this->provider->getAuthorizationUrl();
        session()->set('oauth2state', $this->provider->getState());
        return redirect()->to($authorizationUrl);
    }

    // Méthode commune pour gérer le retour de Facebook
    public function facebookCallback()
    {
        // Vérifie l'état OAuth2
        if ($this->request->getGet('state') !== session()->get('oauth2state')) {
            session()->remove('oauth2state');
            return redirect()->to('/')->with('error', 'Invalid OAuth state');
        }

        try {
            // Récupère l'accès via le code de l'utilisateur
            $accessToken = $this->provider->getAccessToken('authorization_code', [
                'code' => $this->request->getGet('code'),
            ]);

            // Récupère les informations de l'utilisateur
            $user = $this->provider->getResourceOwner($accessToken);
            $facebookUserData = $user->toArray();

            // Détermine si on est dans un contexte d'inscription ou de connexion
            if (session()->get('facebook_action') === 'register') {
                return $this->handleFacebookRegister($facebookUserData);
            } else {
                return $this->handleFacebookLogin($facebookUserData);
            }
        } catch (\Exception $e) {
            return redirect()->to('/loginForm')->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    // Gère l'inscription avec les données Facebook
    private function handleFacebookRegister(array $facebookUserData)
    {
        $userModel = new PatientModel();

        // Vérifie si l'utilisateur existe déjà
        $existingUser = $userModel
            ->where('facebook_id', $facebookUserData['id'])
            ->orWhere('email', $facebookUserData['email'])
            ->first();

        if ($existingUser) {
            return redirect()->to('/register-form')->with('error', 'Cet utilisateur existe déjà. Veuillez vous connecter.');
        }

        // Préparer les données pour l'insertion
        $userData = [
            'facebook_id' => $facebookUserData['id'],
            'nom' => $facebookUserData['first_name'] ?? null,
            'prenom' => $facebookUserData['last_name'] ?? null,
            'email' => $facebookUserData['email'] ?? null,
            'genre' => null,
            'dateNaissance' => null,
            'telephone' => null,
            'historiqueMedical' => null,
            'motDePasse' => null, // Aucun mot de passe pour l'inscription via Facebook
        ];

        // Insérer les données dans la base de données
        if ($userModel->save($userData)) {
            // Rediriger vers la page de connexion avec un message de succès
            return redirect()->to('/loginForm')->with('success', 'Inscription réussie ! Veuillez vous connecter avec vos identifiants Facebook.');
        } else {
            // Récupérer les erreurs de validation
            $errors = $userModel->errors();
            return redirect()->to('/register-form')->with('error', 'Erreur lors de l\'enregistrement de l\'utilisateur : ' . implode(', ', $errors));
        }
    }


    // Gère la connexion avec les données Facebook
    private function handleFacebookLogin(array $facebookUserData)
    {
        $userModel = new PatientModel();
        $existingUser = $userModel->where('facebook_id', $facebookUserData['id'])->orWhere('email', $facebookUserData['email'])->first();

        if ($existingUser) {
            session()->set('userData', value: $existingUser);
            return redirect()->to('/patient-home')->with('success', 'Connexion réussie avec Facebook');
        } else {
            return redirect()->to('/loginForm')->with('error', 'Aucun compte trouvé pour cet utilisateur Facebook.');
        }
    }
}
