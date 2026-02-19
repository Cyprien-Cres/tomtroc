<?php

require_once 'config/autoload.php';
require_once 'config/config.php';

// On récupère l'action demandée par l'utilisateur.
$action = Utils::request('action', 'home');

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
        case 'addNewUser':
            $registerController = new RegisterController();
            $registerController->addNewUser();
            break;
        case 'login':
            $loginController = new LoginController();
            $loginController->showLogin();
            break;
        case 'connectUser':
            $loginController = new LoginController();
            $loginController->connectUser();
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
        case 'updateBook':
            $booksController = new BooksController();
            $booksController->updateBook();
            break;
        case 'showAddBook':
            $booksController = new BooksController();
            $booksController->showAddBook();
            break;
        case 'addBook':
            $booksController = new BooksController();
            $booksController->addBook();
            break;
        case 'delete':
            $booksController = new BooksController();
            $booksController->deleteBook();
            break;
        case 'messaging':
            $messagingController = new MessagingController();
            $messagingController->showMessaging();
            break;
        case 'sendMessage':
            $messagingController = new MessagingController();
            $messagingController->sendMessage();
            break;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
