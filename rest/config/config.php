<?php
define('LOG_FILE', __DIR__ . '/../logs/debug.log');
define('DEBUG', true);

/* Environment */
define('VERSION', '1.0');
define('ENV', 'DEV'); // PROD for https, DEV for local running

define('DOCS_FOLDER', 'docs'); // relative path from the project root
/* Folders/files containing OpenAPI annotations. */
define('DOCS_ANNOTATION_LOCATIONS', [
    __DIR__ . '/../app/models/',
    __DIR__ . '/../app/routes/',
    __DIR__ . '/../app/dao/',
    __DIR__ . '/../docs/doc_setup.php'
]);

/* Project definitions */
if (explode(' ', php_uname('s'))[0] === 'Windows') {
    $slash = "\\";
} else {
    $slash = '/';
}

/* Define the API base path */
if ((empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') && ENV === 'PROD') {
    $base_path = 'https://' . $_SERVER['HTTP_HOST'] . '/';
} else {
    $base_path = 'http://localhost/canteenms/rest'; // $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $slash . explode($slash, $_SERVER['REQUEST_URI'])[1];
}
define('API_BASE_PATH', $base_path);
define('SERVER_ROOT', __DIR__ . '/..');

define('AUTH_HEADER_NAME', 'authorization'); // name of the authorization header to be used
define('SERVER_DESCRIPTION', 'Canteen.'); // description of the host server
define('PROJECT_TITLE', 'Canteen'); // project title
define('PROJECT_DESCRIPTION', ''); // project description
define('PROJECT_VERSION', '1.0'); // project version
define('PROJECT_DOCS_TITLE', 'Canteen'); // title of the HTML page for the generated documentation

/* Author/team definitions */
define('AUTHOR_NAME', 'Sajra Agić');
define('AUTHOR_EMAIL', 'sajra.agic@stu.ibu.edu.ba');
define('AUTHOR_URL', '');

// DB settings
/*define('CONNECTION_STRING', "mysql:host=sql7.freemysqlhosting.net;dbname=sql7341110");
define('DB_USER', "sql7341110");
define('DB_PASS', "iVHrQt9qb1");*/

// mongodb settings
define('CONNECTION_STRING', "mysql:host=127.0.0.1;dbname=canteenms");
define('DB_USER', "root");
define('DB_PASS', "password");



// jwt settings
define('JWT_KEY', "canteen-token");
define('JWT_TOKEN_VALIDITY', "+10 days"); // example; +5minutes, +1 hour
