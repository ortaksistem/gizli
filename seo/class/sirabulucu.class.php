<?php
class GPositionFinder {
    
    private $_keyword;
    private $_page;
    private $_offset = 0;
    private $_apiUrl = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&hl=tr&lr=tr&rsz=large&q=";
    private $_referer = NULL;
    private $_results;
    private $_position = 0;
    private $_output;
    private $_outputMethod = 'json';
    private $_liste = array();
    private $_htmlist;
    
    public function __construct($keyword=null, $page=null) {
        $this->setKeyword($keyword);
        $this->setPage($page);
    }
    
    public function setReferer($value) {
        if ($value) {
            $this->_referer = $value;
            return true;
        }
        return false;
    }
    
    public function setKeyword($value) {
        if ($value) {
            $this->_keyword = urlencode($value);
            return true;
        }
        return false;
    }
    
    public function setPage($value) {
        if ($value) {
            $this->_page = basename($value);
            return true;
        }
        return false;
    }
    
    public function setOutputMethod($value) {
        switch ($value) {
            case 'json':
                $this->_outputMethod = 'json';
                break;
            case 'text':
                $this->_outputMethod = 'text';
                break;
            default:
                return false;
        }
        return true;
    }
    
    public function getPosition() {
        return $this->_position;
    }
    
    public function getOutput() {
        return $this->_output;
    }
	
    
    public function go() {
		$this->_offset=0;
		
        if (!$this->_setApiUrl()) {
            trigger_error('You must set a valid keyword before calling go().', E_USER_ERROR);
        }
        if (!$this->_page) {
            trigger_error('You must set a valid page to check before calling go().', E_USER_ERROR);
        }
        while(!$this->_position && $this->_offset < 40) {
            $this->_getNextResultSet();
            if (empty($this->_results) || !is_object($this->_results)) {
                break;
            }
            $this->_checkPosition();
        }
        $output = null;
        switch ($this->_outputMethod) {
            case 'json':
                $output = json_encode(array(
                    'position' => $this->_position,
                    'keyword' => urldecode($this->_keyword),
                    'page' => $this->_page
                ));
                break;
            case 'text':
                $output = "position={$this->_position}&keyword=" . rawurldecode($this->_keyword) .
                          "&page={$this->_page}";
            break;
        }
		
        return $this->_output = $output;
    }
	
	 public function liste() {
			
			 $this->_offset=0;
			if (!$this->_setApiUrl()) {
				trigger_error('You must set a valid keyword before calling go().', E_USER_ERROR);
			}
			if (!$this->_page) {
				trigger_error('You must set a valid page to check before calling go().', E_USER_ERROR);
			}
			$this->_getNextResultSet();
			
			
			$this->_htmlist="<ul>";
			foreach ($this->_results->responseData->results as $key => $result) {
				if(strpos($result->unescapedUrl , $this->_page) !== false){
					$this->_htmlist.="<li class='buu'><a href='".$result->unescapedUrl."'>".$result->unescapedUrl."</a></li>";
				}else{
					$this->_htmlist.="<li><a href='".$result->unescapedUrl."'>".$result->unescapedUrl."</a></li>";
				}
			}
			$this->_htmlist.="<ul>";
				
			return $this->_htmlist;
    }
    
    private function _setApiUrl($url=null) {
        if (!$this->_keyword) {
            return false;
        }
        $this->_apiUrl = $this->_apiUrl.$this->_keyword;
        return true;
    }
    
    private function _getNextResultSet() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_apiUrl . "&start={$this->_offset}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31');
        curl_setopt($ch, CURLOPT_REFERER, $this->_referer);
        $body = curl_exec($ch);
        curl_close($ch);
        $this->_results = json_decode($body);
    }
	
    private function _checkPosition() {
        foreach ($this->_results->responseData->results as $key => $result) {
			if(strpos($result->unescapedUrl , $this->_page) !== false){
				$this->_position = $this->_offset + 1;
			}
			else {
                $this->_offset++;
            }
        }
		return;
    }
    
}
?>