<?
include_once 'classes/IMDB.php';
include_once 'classes/Bitrix.php';
include_once 'classes/Log.php';

use API\IMDB,
	API\Bitrix,
	API\Log;

class Loader{
	public function __construct(){
		self::postFilm();
	}

	protected function postFilm(){
		try {
			$film = new API\IMDB('The Hateful Eight', '2015');
			API\Bitrix::addComment($film->getFilmInfo(), $film->getPoster()); 
		} catch (Exception $e) { 
			API\Log::Add($e->getMessage(), 'Loader::postFilm');
		}
	}
}

new Loader();
?>