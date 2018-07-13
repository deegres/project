<?
namespace API;

class IMDB{

	const API_KEY = "bed3cb31";
	const TYPE = "movie";
    const IMDB_LOG_FILE = "imdb_log.txt";

    function __construct($film_name, $year){
        $this->film_name = urlencode($film_name);
        $this->year = $year;
    }

	public function getFilmInfo(){
		try{
	        $this->query = "http://www.omdbapi.com/?apikey=".self::API_KEY."&t={$this->film_name}&y={$this->year}";
	        $curl = curl_init();
	        curl_setopt_array($curl, array(
	            CURLOPT_RETURNTRANSFER => true,
	            CURLOPT_TIMEOUT => 5,
	            CURLOPT_URL => $this->query,
	        ));

	        $this->result = json_decode(curl_exec($curl), 1);
	        curl_close($curl);
	        \API\Log::Add($this->result, 'Bitrix::getFilmInfo');
	        return $this->result;

	    }catch(Exception $e){
            \API\Log::Add($e->getMessage(), 'IMDB::getFilmInfo');
        }
	}

	public function getPoster(){
		return $this->result['Poster'];
	}

}

?>