<?php
namespace Fbreuer\Cms;

class Crawler
{
    protected $_url;
    protected $_depth;
    protected $_host;
    protected $_useHttpAuth = false;
    protected $_user;
    protected $_pass;
    protected $_openLinks = array();
    protected $_result = array();
    protected $_keywords = array();
    protected $_objekts = array();


    public function __construct($url, $depth = 5, $_keywords = null, $_objekts = "link")
    {
        $this->_url = $url;
        $this->_depth = $depth;
        $parse = parse_url($url);
        $this->_host = $parse['host'];
        $this->_keywords = $_keywords;
        $this->_objekts = $_objekts;
    }

    public function filterHtml($xPath)
    {
        $elements = array();
        foreach($this->_objekts as $objekt){
            if($objekt == "link"){
                $elements[1] = $xPath->query("//a/@href");
                if($this->_depth > 0){
                    foreach ($elements[1] as $e) {
                        if (!in_array($e->nodeValue, $this->_openLinks)) {
                            $this->crawlSite($e->nodeValue);
                        }
                    }
                }

            }elseif($objekt == "image"){
                $elements[2] = $xPath->query("//img/@src");
            }elseif($objekt == "text"){
                $elements[3] = $xPath->query("//p");
            }elseif($objekt == "form"){
                $elements[4] = $xPath->query("//form");
            }elseif($objekt == "pdf"){
                $elements[5] = $xPath->query("//a/@href");
            }
        }

        foreach ($elements as $element) {
            $this->checkForKeaywords($element);
        }

    }


    public function checkForKeaywords($element){

        if(isset($this->_keywords) and $this->_keywords != null){
            foreach ($element as $e) {
                $pos = strpos($e->nodeValue, $this->_keywords[0]);
                if($pos){
                    if (!in_array($e->nodeValue, $this->_result)) {
                        array_push($this->_result, $e->nodeValue);
                    }
                }
            }
            if(empty($this->_result)){
                array_push($this->_result, "kein Ergebins gefunden");
            }
        }else{
            foreach ($element as $e) {
                if (!in_array($e->nodeValue, $this->_result)) {
                    array_push($this->_result, $e->nodeValue);
                }
            }
        }

    }

    protected function isValid($url)
    {
        if (strpos($url, $this->_host) === false){
            if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
                return false;
            } else {
                return true;
            }
        }else{ returnfalse; }

    }


    public function crawlSite($url = null){

        $url = filter_var($url, FILTER_SANITIZE_URL);
        if($url === null){
            array_push($this->_openLinks, $this->_url);
            $html = file_get_contents($this->_url);
        }else{
            if (!in_array($url, $this->_openLinks)) {
                $pos = strpos($url, "http://");

                if($this->isValid($url)){
                    if($pos == false){
                        $html= file_get_contents("http://".$this->_host.$url);
                    }else{
                        $html= file_get_contents("http://".$url);

                    }
                    array_push($this->_openLinks, $url);
                }
            }
        }
        $this->_depth = $this->_depth - 1;


        $dom = new \DOMDocument('1.0');
        @$dom->loadHTML($html);

        $xPath = new \DOMXPath($dom);

        $elements = $this->filterHtml($xPath);

    }

    public function run()
    {

        $this->crawlSite();



        return $this->_result;
    }
}