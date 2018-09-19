<?php

namespace App\Services\Pdf;

class Generator {
	
	private $url;

	private $outputPath;

	private $type;

	public function __construct() {
		//
	}

	public function setUrl($url) {
		$this->url = $url;
		return $this;
	}

	public function setOutputPath ($path) {
		$this->outputPath = $path;
		return $this;
	}

	public function setType ($type) {
		$this->type = $type;
		return $this;
	}

	public function execute($url = '', $outputPath = '', $type = '') {
		if (empty($url)) {
			$url = $this->url;
		}
		if (empty($outputPath)) {
			$outputPath = $this->outputPath;
		}

		if(empty($type)) {
			$type = $this->type;
		}

		$cmd;
		if($type=='pdf') {

			$cmd = "wkhtmltopdf $url $outputPath";
		}
		else {
			$cmd = "wkhtmltoimage $url $outputPath";
		}

		shell_exec($cmd);
	}
}