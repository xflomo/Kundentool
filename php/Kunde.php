<?php
namespace Fbreuer\Cms;


class Kunde
{
    protected $name;



    public function __construct($url, $depth = 5, $_keywords = null, $_objekts = "link")
    {
        $this->_url = $url;
        $this->_depth = $depth;
        $parse = parse_url($url);
        $this->_host = $parse['host'];
        $this->_keywords = $_keywords;
        $this->_objekts = $_objekts;
    }
}