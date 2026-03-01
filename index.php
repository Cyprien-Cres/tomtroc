<?php

require_once 'config/autoload.php';
require_once 'config/config.php';

$action = Utils::request('action', 'home');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri !== '' && $uri !== '/' && $uri !== '/index.php') {
    if (is_file(__DIR__ . $uri)) {
        return false;
    }
}

$isIndex = in_array($uri, ['', '/', '/index.php']);

$hasQueryString = !empty($_SERVER['QUERY_STRING']);
$hasAction = isset($_GET['action']);

if (!$isIndex || ($hasQueryString && !$hasAction)) {
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => "La page demandée n'existe pas."]);
    exit;
}

// Try catch global pour gérer les erreurs
try {
    // Pour chaque action, on appelle le bon contrôleur et la bonne méthode.
    switch ($action) {
        // Pages accessibles à tous.
        case 'home':
            $homeController = new HomeController();
            $homeController->showHome();
            break;
        case 'books':
            $booksController = new BooksController();
            $booksController->showBooks();
            break;
        case 'detailBook':
            $booksController = new BooksController();
            $booksController->showBookDetail();
            break;
        case 'register':
            $registerController = new RegisterController();
            $registerController->showRegister();
            break;
        case 'login':
            $loginController = new LoginController();
            $loginController->showLogin();
            break;
        case 'logout':
            $loginController = new LoginController();
            $loginController->logout();
            break;
        case 'publicAccount':
            $accountController = new AccountController();
            $accountController->showAccountPublic();
            break;
        case 'account':
            $accountController = new AccountController();
            $accountController->showAccount();
            break;
        case 'updateUser':
            $accountController = new AccountController();
            $accountController->updateUser();
            break;
        case 'updateUserImg':
            $accountController = new AccountController();
            $accountController->updateUserImg();
            break;
        case 'edit':
            $booksController = new BooksController();
            $booksController->showBook();
            break;
        case 'showAddBook':
            $booksController = new BooksController();
            $booksController->showAddBook();
            break;
        case 'delete':
            $booksController = new BooksController();
            $booksController->deleteBook();
            break;
        case 'messaging':
            $messagingController = new MessagingController();
            $messagingController->showMessaging();
            break;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
