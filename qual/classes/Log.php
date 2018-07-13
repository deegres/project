<?
namespace API;

class Log{

	public function __construct(){
		
	}

	public function Add($data, $class){		      
		$file = fopen('/home/c/cr33395/public_html/qual/logs/qual.log', 'a+');
		ob_start ();
			echo "\n\n[".date("F d Y H:i:s", time())."][".$class."] \n";
			print_r ($data);
			$arLog[] = ob_get_contents();
		ob_end_clean ();  
		fwrite ($file,implode("\n",$arLog));
		fclose ($file);
	}
}