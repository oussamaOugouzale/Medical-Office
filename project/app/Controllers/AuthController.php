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

    public function facebookRegister()
    {
        $authorizationUrl = $this->provider->getAuthorizationUrl();
        session()->set('oauth2state', $this->provider->getState());
        return redirect()->to($authorizationUrl);
    }

    public function facebookLogin()
    {
        $authorizationUrl = $this->provider->getAuthorizationUrl();
        session()->set('oauth2state', $this->provider->getState());
        return redirect()->to($authorizationUrl);
    }

    public function facebookCallback()
    {
        if ($this->request->getGet('state') !== session()->get('oauth2state')) {
            session()->remove('oauth2state');
            return redirect()->to('/')->with('error', 'Invalid OAuth state');
        }

        try {
            $accessToken = $this->provider->getAccessToken('authorization_code', [
                'code' => $this->request->getGet('code'),
            ]);

            $user = $this->provider->getResourceOwner($accessToken);
            $facebookUserData = $user->toArray();

            if (session()->get('facebook_action') === 'register') {
                return $this->handleFacebookRegister($facebookUserData);
            } else {
                return $this->handleFacebookLogin($facebookUserData);
            }
        } catch (\Exception $e) {
            return redirect()->to('/loginForm')->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    private function handleFacebookRegister(array $facebookUserData)
    {
        $userModel = new PatientModel();

        $existingUser = $userModel
            ->where('facebook_id', $facebookUserData['id'])
            ->orWhere('email', $facebookUserData['email'])
            ->first();

        if ($existingUser) {
            return redirect()->to('/register-form')->with('error', 'Cet utilisateur existe déjà. Veuillez vous connecter.');
        }

        $userData = [
            'facebook_id' => $facebookUserData['id'],
            'nom' => $facebookUserData['first_name'] ?? null,
            'prenom' => $facebookUserData['last_name'] ?? null,
            'email' => $facebookUserData['email'] ?? null,
            'genre' => null,
            'dateNaissance' => null,
            'telephone' => null,
            'historiqueMedical' => null,
            'motDePasse' => null, 
        ];

        if ($userModel->save($userData)) {
            return redirect()->to('/loginForm')->with('success', 'Inscription réussie ! Veuillez vous connecter avec vos identifiants Facebook.');
        } else {
            $errors = $userModel->errors();
            return redirect()->to('/register-form')->with('error', 'Erreur lors de l\'enregistrement de l\'utilisateur : ' . implode(', ', $errors));
        }
    }


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
