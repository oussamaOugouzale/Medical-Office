

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@22.0.1/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@22.0.1/build/js/intlTelInput.min.js"></script>
    <style>

    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <button id="menu-btn" type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 flex items-center justify-between sm:items-stretch sm:justify-between">
                        <a href="#" class="flex-shrink-0">
                            <img class="h-8 w-auto" src="{{ asset('images/doccure.png') }}" alt="Doccure">
                        </a>
                        <div class="hidden sm:block sm:ml-6">
                            <div class="flex space-x-4">
                                <a href="{{route('home')}}"
                                    class="text-gray-700 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
                                <a href="#"
                                    class="text-gray-700 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                                <a href="#"
                                    class="text-gray-700 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Qui
                                    sommes nous ?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sm:hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{route('home')}}"
                        class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
                    <a href="#"
                        class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contact</a>
                    <a href="#"
                        class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Qui
                        sommes nous ?</a>
                </div>
            </div>
        </nav>
        <div class="flex justify-center mt-10">
            <div class="w-full max-w-5xl flex flex-col md:flex-row items-center justify-center">
                <div class="w-full md:w-1/2 mb-8 md:mb-0 md:mr-8">
                    <img src="<?= base_url('images/login-banner.png') ?>" class="w-full h-auto" alt="Login Banner">
                </div>
                <div class="w-full md:w-1/2">
                    <div class="bg-white shadow-md rounded px-6 py-6 mb-4">
                        <form action="<?= route_to('register') ?>" method="post" class="form">
                            <?= csrf_field() ?>
                            <div class="my-4">
                                <a href="#" class="block">
                                    <button
                                        class="w-full text-center text-white py-2 my-2 border flex items-center justify-center bg-blue-500 border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:shadow transition duration-150">
                                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 8 19">
                                            <path fill-rule="evenodd"
                                                d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>S'inscrire avec Facebook</span>
                                    </button>
                                </a>
                                <a href="#" class="block">
                                    <button
                                        class="w-full text-center py-2 my-2 border flex items-center justify-center border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150">
                                        <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5 mr-2"
                                            alt="Google Icon">
                                        <span>S'inscrire avec Google</span>
                                    </button>
                                </a>
                            </div>
                            <div class="inline-flex items-center justify-center w-full mb-3">
                                <hr class="w-3/4 h-px my-2 bg-gray-300 border-0">
                                <span class="absolute px-2 font-medium text-gray-900 bg-white">OU</span>
                            </div>
                            <div class="inputs space-y-2">
                                <div class="flex flex-col items-center">
                                    <div class="text-sm text-gray-700 mb-1">
                                        Merci de saisir vos informations
                                    </div>
                                    <div class="flex space-x-2">
                                        <div class="flex">
                                            <input id="genre-femme" type="radio" name="genre" value="femme"
                                                <?= old('genre') === 'femme' ? 'checked' : '' ?>
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                            <label for="genre-femme"
                                                class="ml-1 text-xs font-medium text-gray-800">Femme</label>
                                        </div>
                                        <div class="flex">
                                            <input id="genre-homme" type="radio" name="genre" value="homme"
                                                <?= old('genre') === 'homme' ? 'checked' : '' ?>
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500">
                                            <label for="genre-homme"
                                                class="ml-1 text-xs font-medium text-gray-800">Homme</label>
                                        </div>
                                    </div>

                                    <?php if (session('emailExists')): ?>
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-4"
                                            role="alert">
                                            <strong class="font-bold">Erreur!</strong>
                                            <span class="block sm:inline"><?= session('emailExists') ?></span>
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <label for="UserName"
                                    class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-2 shadow-sm focus-within:border-gray-300 focus-within:ring-1 focus-within:ring-gray-300">
                                    <input type="text" placeholder="Nom" name="nom" value="<?= old('nom') ?>"
                                        class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:outline-none focus:ring-0 sm:text-sm" />
                                    <span
                                        class="absolute left-3 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Nom</span>
                                </label>
                                <?php if (session('validation.nom')): ?>
                                    <div class="text-red-600 text-sm mt-1"><?= session('validation.nom') ?></div>
                                <?php endif; ?>

                                <label for="UserPrenom"
                                    class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-2 shadow-sm focus-within:border-gray-300 focus-within:ring-1 focus-within:ring-gray-300">
                                    <input type="text" name="prenom" placeholder="Prénom" value="<?= old('prenom') ?>"
                                        class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:outline-none focus:ring-0 sm:text-sm" />
                                    <span
                                        class="absolute left-3 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Prénom</span>
                                </label>
                                <?php if (session('validation.prenom')): ?>
                                    <div class="text-red-600 text-sm mt-1"><?= session('validation.prenom') ?></div>
                                <?php endif; ?>

                                <label for="UserEmail"
                                    class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-2 shadow-sm focus-within:border-gray-300 focus-within:ring-1 focus-within:ring-gray-300">
                                    <input type="email" name="email" id="UserEmail" placeholder="Email"
                                        value="<?= old('email') ?>"
                                        class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:outline-none focus:ring-0 sm:text-sm" />
                                    <span
                                        class="absolute left-3 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Email</span>
                                </label>
                                <?php if (session('validation.email')): ?>
                                    <div class="text-red-600 text-sm mt-1"><?=session('validation.email') ?></div>
                                <?php endif; ?>

                                <label for="phone"
                                    class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-2 shadow-sm focus-within:border-gray-300 focus-within:ring-1 focus-within:ring-gray-300">
                                    <input type="tel" id="phone" value="<?= old('numéro') ?>" name="numéro"
                                        class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:outline-none focus:ring-0 sm:text-sm"
                                        placeholder="Numéro de mobile" required />
                                    <span
                                        class="absolute left-3 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Numéro
                                        de mobile</span>
                                </label>
                                <?php if (session('validation.numéro')): ?>
                                    <div class="text-red-600 text-sm mt-1"><?=session('validation.numéro') ?></div>
                                <?php endif; ?>

                                <label for="UserPassword"
                                    class="relative block overflow-hidden rounded-md border border-gray-200 px-3 pt-2 shadow-sm focus-within:border-gray-300 focus-within:ring-1 focus-within:ring-gray-300">
                                    <input type="password" id="UserPassword" name="password"
                                        value="<?= old('password') ?>" placeholder="Mot de passe"
                                        class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:outline-none focus:ring-0 sm:text-sm" />
                                    <span
                                        class="absolute left-3 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">Mot
                                        de passe</span>
                                </label>
                                <?php if (session('validation.password')): ?>
                                    <div class="text-red-600 text-sm mt-1"><?= session('validation.password') ?></div>
                                <?php endif; ?>

                                <div class="flex flex-col items-center">
                                    <div class="text-sm text-gray-700 mb-1">Merci de choisir votre type d'inscription
                                    </div>
                                    <div class="flex space-x-2">
                                        <div class="flex ">
                                            <input id="type-patient" type="radio" value="patient" name="user_type"
                                                required
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                                                <?= old('user_type') === 'patient' ? 'checked' : '' ?>>
                                            <label for="type-patient"
                                                class="ml-1 text-xs font-medium text-gray-800">Patient</label>
                                        </div>
                                        <div class="flex ">
                                            <input id="type-doctor" type="radio" value="doctor" name="user_type"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                                                <?= old('user_type') === 'doctor' ? 'checked' : '' ?>>
                                            <label for="type-doctor"
                                                class="ml-1 text-xs font-medium text-gray-800">Médecin</label>
                                        </div>
                                        <div class="flex ">
                                            <input id="type-secretaire" type="radio" value="secretaire" name="user_type"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500"
                                                <?= old('user_type') === 'secretaire' ? 'checked' : '' ?>>
                                            <label for="type-secretaire"
                                                class="ml-1 text-xs font-medium  text-gray-800">Secrétaire</label>
                                        </div>
                                    </div>
                                </div>
                                <!-------------------------------------------------------------------------------------->

                                <div class="flex items-start my-4">
                                    <div class="flex items-center h-5">
                                        <input id="terms" type="checkbox" value="1" name="terms"
                                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                                            required <?= old('terms') ? 'checked' : '' ?>>
                                    </div>
                                    <label for="terms" class="ml-2 text-sm font-medium text-gray-900">
                                        Je suis d'accord avec les
                                        <a href="<?= base_url('pdfs/gcu.pdf') ?>" target="_blank"
                                            class="text-blue-600 hover:underline">GCU</a>
                                        et
                                        <a href="<?= base_url('pdfs/politique.pdf') ?>" target="_blank"
                                            class="text-blue-600 hover:underline">la politique de confidentialité</a>
                                    </label>
                                </div>

                                <button type="submit"
                                    class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center">Soumettre</button>

                                <div class="flex mt-2 w-full">
                                    <a href="<?= route_to('loginForm') ?>"
                                        class="text-sm text-blue-600 underline hover:no-underline">Vous avez déjà un
                                        compte ?</a>
                                </div>

                                <script>
                                    

                                    document.getElementById('menu-btn').addEventListener('click', function () {
                                        document.getElementById('mobile-menu').classList.toggle('hidden');
                                    });
                                </script>
</body>

</html>