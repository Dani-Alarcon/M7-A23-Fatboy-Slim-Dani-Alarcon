<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate App
$app = AppFactory::create();

// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Route: Show musicians from DB
$app->get('/', function (Request $request, Response $response) {
    // Conectar a SQLite
    $db = new SQLite3('cantants.db');
    $result = $db->query('SELECT * FROM musics');

    // Construir HTML
    $html = '<!DOCTYPE html>';
    $html .= '<html lang="ca">';
    $html .= '<head>';
    $html .= '<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>Cantants</title>';
    // Google Fonts
    $html .= '<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">';
    // Tailwind CDN with custom config
    $html .= '<script src="https://cdn.tailwindcss.com"></script>';
    $html .= '<script>tailwind.config = {theme: {fontFamily: {sans: ["Poppins", "sans-serif"]}}}</script>';
    $html .= '</head>';
    $html .= '<body class="bg-gray-100 font-sans">';

    // Header
    $html .= '<header class="bg-gradient-to-r from-red-600 via-pink-500 to-purple-600 text-white py-6 shadow-lg">';
    $html .= '<div class="container mx-auto px-6 flex items-center justify-between">';
    $html .= '<h1 class="text-4xl font-extrabold">Cantants</h1>';
    $html .= '</div></header>';

    $html .= '<main class="container mx-auto p-6 flex-grow">';

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        // Preparar hipervincles
        $links = array_map('trim', explode(',', $row['hipervincles']));
        $linkHtml = '';
        foreach ($links as $link) {
            $host = htmlspecialchars(parse_url($link, PHP_URL_HOST));
            $linkHtml .= '<a href="'.htmlspecialchars($link).'" target="_blank" class="inline-block bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm mr-2 mb-2">';
            $linkHtml .= '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172l-4.243 4.243m0-4.243l4.243 4.243"/></svg>' . $host . '</a>';
        }
        // Tarjeta neumórfica
        $html .= '<section class="bg-white rounded-2xl p-1 mb-6 flex flex-col md:flex-row gap-6 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">';
        // Imagen
        $html .= '<div class="md:w-1/3 bg-gray-200 rounded-2xl p-4 flex items-center justify-center">';
        $html .= '<img src="'.htmlspecialchars($row['imatges']).'" alt="'.htmlspecialchars($row['nom']).'" class="rounded-xl shadow-md max-h-48 object-contain">';
        $html .= '</div>';
        // Info
        $html .= '<div class="md:w-2/3 bg-white rounded-2xl p-6">';
        $html .= '<h2 class="text-3xl font-bold mb-4 flex items-center text-gray-800">';
        $html .= '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-2v13"/></svg>' . htmlspecialchars($row['nom']);
        $html .= '</h2>';
        $html .= '<div class="prose prose-lg text-gray-700 mb-4">' . nl2br(htmlspecialchars($row['biografia'])) . '</div>';
        $html .= '<div class="flex flex-wrap">' . $linkHtml . '</div>';
        $html .= '</div>';
        $html .= '</section>';
    }

    $html .= '</main>';
    $html .= '</body></html>';

    $response->getBody()->write($html);
    return $response;
});

// Run App
$app->run();
