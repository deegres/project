<?
namespace API;

class Bitrix{

	const BX_REST = "https://itgrade.bitrix24.ru/rest";
	const BX_USER = "502";
	const BX_KEY = "sl68qroz1mel8wpa";
	const BX_TASK = "21065";

	public function __construct(){
		
	}

	public function addComment($fulldata, $poster){
		try{
			$this->poster = $poster;
			$this->fulldata = $fulldata;

		 	$queryUrl = self::BX_REST.'/'.self::BX_USER.'/'.self::BX_KEY.'/task.commentitem.add';
		 	$queryData = http_build_query(array(
				'taskId' => self::BX_TASK,
				'fields' => array(
					'POST_MESSAGE' => self::getFormatData()
					)
			 ));

			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_TIMEOUT => 5,
			CURLOPT_POST => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $queryUrl,
			CURLOPT_POSTFIELDS => $queryData,
			));

			$result = json_decode(curl_exec($curl), 1);
			curl_close($curl);

			if (array_key_exists('error', $result)) 
	 			return $result['error'];

	 		\API\Log::Add($result, 'Bitrix::addComment');
			
			return $result;
		} catch(Exception $e){
            \API\Log::Add($e->getMessage(), 'Bitrix::addComment');
        }

	}

	protected function getFormatData(){
		try{
			$data .= '<img src = ' . $this->poster . ' /><br>';
			foreach ($this->fulldata as $key => $value) {
				$data .= '<b>' . $key . '</b>: ' . $value . '<br>';
			}
			\API\Log::Add($data, 'Bitrix::getFormatData');
			return $data;
		} catch(Exception $e){
            \API\Log::Add($e->getMessage(), 'Bitrix::getFormatData');
        }

	}

}
?>