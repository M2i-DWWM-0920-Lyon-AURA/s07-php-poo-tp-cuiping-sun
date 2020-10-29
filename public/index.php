<?php

// ================================================================
// Front controller
// ----------------------------------------------------------------
// ~ Toutes les requêtes sont redirigées sur ce fichier grâce au
// fichier .htaccess.
// ================================================================

// Active le chargement automatique des classes grâce à Composer

use App\Controller\ViewController;

require '../vendor/autoload.php';

// Crée un nouveau routeur
$router = new AltoRouter();


// ================================================================
// Routes
// ----------------------------------------------------------------
// ~ Associe une fonction à chaque route disponible dans notre 
// application.
// ================================================================

// Page d'accueil
$router->map('GET', '/', function() {
	ViewController::home();
});

// Page des tâches à faire
$router->map('GET', '/todos', function() {
	ViewController::List();
});

// Page modification d'une tâche à faire existante avant validation
$router->map('POST', '/todos', function () {
	ViewController::List();
});

// Page modification d'une tâche à faire existante après validation
$router->map('POST', '/todos/[i:id]/update', function () {
	ViewController::update();
});

// Page de Création d'une nouvelle tâche à faire
$router->map('POST', '/todos/new', function () {
	ViewController::new();
});

// Page suppression d'une tâche à faire existante
$router->map('POST', '/todos/[i:id]/delete', function () {
	ViewController::delete();
});


// ================================================================
// Routeur
// ----------------------------------------------------------------
// ~ Le routeur récupère la fonction associée à la route demandée
// et l'exécute, ou produit une page 404 si aucune route n'a été
// trouvée.
// ~ Cette partie du code vérifie que vous avez bien associé une
// fonction à chaque route, sinon elle produit une erreur.
// ================================================================

// Cherche une correspondance entre la requête de l'utilisateur et les routes connues
$match = $router->match();

// Si une correspondance a été trouvée
if( is_array($match)) {
	// Si la valeur renvoyée par le routeur n'est pas une fonction
	if (!is_callable( $match['target'] )) {
		// Produire une erreur
		$type = gettype($match['target']);
		return new TypeError("Routes must return a function ($type given).");
	}
	// Appelle la fonction associée à la route
	call_user_func_array( $match['target'], $match['params'] ); 
// Sinon
} else {
	// Renvoie la page 404 du serveur
	header('Location: ' . ViewController::notFound());
}
