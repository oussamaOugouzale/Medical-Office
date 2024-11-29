
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/register.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@22.0.1/build/css/intlTelInput.css">
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@22.0.1/build/js/intlTelInput.min.js"></script>
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
                            <img class="h-8 w-auto" src="<?= base_url('images/doccure.png') ?>" alt="Doccure">
                        </a>
                        <div class="hidden sm:block sm:ml-6">
                            <div class="flex space-x-4">
                                <a href="<?= base_url('/') ?>"
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
                    <a href="<?= base_url('/') ?>"
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
                <div class=" w-full md:w-1/2 mb-8 md:mb-0 md:mr-8">
                    <img src="<?= base_url('images/login-banner.png') ?>" class="w-full h-auto" alt="Login Banner">
                </div>
                <div class="w-full md:w-1/2">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4 text-center">
                            <h1 class="text-2xl font-bold">Connexion</h1>
                            <a href="<?= base_url('register-form') ?>" class="underline text-blue-500">S'inscrire</a>
                        </div>
                        <div class="mb-4">
                            <button
                                class="w-full bg-blue-600 text-white py-2 px-4 rounded flex items-center justify-center">
                                <i class="fab fa-facebook-f mr-2"></i> Se connecter avec Facebook
                            </button>
                            <button
                                class="w-full bg-white text-gray-700 py-2 px-4 rounded flex items-center justify-center mt-2 border">
                                <img src="https://www.svgrepo.com/show/355037/google.svg" class="mr-2" width="20"
                                    alt="Google Icon"> Se connecter avec Google
                            </button>
                        </div>

                        <?php if (session()->get('user_added')): ?>
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-4"
                                role="alert">
                                <strong class="font-bold">Succès!</strong>
                                <span class="block sm:inline"><?= session()->get('user_added') ?></span>

                            </div>
                        <?php endif; ?>

                        <div class="relative flex items-center justify-center mb-4">
                            <div class="w-full border-t border-gray-300"></div>
                            <span class="absolute bg-white px-3">OU</span>
                        </div>
                        <form action="<?= base_url('send-login-form') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-4">
                                <label for="UserEmail" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                                <input type="email" id="UserEmail" name="email" value="<?= old('email') ?>"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= session('errors.email') ? 'border-red-500' : '' ?>">
                                <?php if (session('errors.email')): ?>
                                    <p class="text-red-500 text-xs italic"><?= session('errors.email') ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-6">
                                <label for="UserPassword"
                                    class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                                <input type="password" id="UserPassword" name="password"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?= session('errors.password') ? 'border-red-500' : '' ?>">
                                <?php if (session('errors.password')): ?>
                                    <p class="text-red-500 text-xs italic"><?= session('errors.password') ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="flex items-center justify-center">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Soumettre</button>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="#" class="text-blue-500 text-sm">Vous avez perdu votre mot de passe ?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>