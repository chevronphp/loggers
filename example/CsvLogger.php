<?php

class CsvLogger {

	/** the default delim for csv rows */
	protected $delim = "\t";

	/**
	 * add a row to the log as TSV data
	 */
	public function __invoke($level, $message = "", array $context = []){

		$entry = [];
		array_push($entry, "level", $level, "message", $message);

		foreach($context as $key => $value){
			array_push($entry, $key, json_encode($value));
			// gettype($value)
		}

		array_push($entry, "__timestamp", date(\DateTime::RFC3339));

		echo $this->encodeAsCSV($entry);
	}

	/**
	 * flatten an array into a csv encoded string
	 * @param array $data the data to encode
	 * @return string
	 */
	public function encodeAsCSV(array $data){
		$fp = fopen('php://temp', 'w+');
		$data = $this->flattenValues($data);
		fputcsv($fp, array_values($data), $this->getCSVDelim());
		rewind($fp);
		// $csv = fread($fp, \WM\ONE_KB);
		$csv = stream_get_contents($fp);
		fclose($fp);
		return $csv;
	}

	/** set the delim */
	public function setCSVDelim($delim){
		$this->delim = $delim;
	}

	/** interlace an associative array */
	public function interlaceAssocArray(array $array){
		$return = [];
		foreach($array as $key => $value){
			$return[] = $key;
			$return[] = $value;
		}
		return $return;
	}

	/**
	 * take each value and, if array, concat to a comma string
	 * @param array $value the data
	 * @return array
	 */
	protected function flattenValues(array $value){
		array_walk($value, function(&$v, $k){
			if(is_array($v)){
				$v = implode(",", $v);
			}
		});
		return $value;
	}

	/**
	 * allow implementing classes to stipulate the CSV field delimiter
	 * @return string
	 */
	public function getCSVDelim(){
		return $this->delim;
	}

}

$logger = \Chevron\Loggers\UserFuncLogger(new CsvLogger);
