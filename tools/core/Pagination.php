<?php


namespace tools\core;


class Pagination
{
    /** @var float|int|mixed  */
    public $currentPage;

    /** @var  */
    public $perpage;

    /** @var  */
    public $total;

    /** @var float|int  */
    public $countPages;

    /** @var string  */
    public $uri;

    /**
     * Pagination constructor.
     * @param $page
     * @param $perpage
     * @param $total
     */
    public function __construct($page, $perpage, $total){
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    /**
     * @return string
     */
    public function display(){
        $startpage = null;
        $endpage = null;
        $page2left = null;
        $page1left = null;
        $page2right = null;
        $page1right = null;
        $back = "<li class='pagination__item'><a href='{$this->uri}page=". ($this->currentPage - 1) . "' class='pagination__link'><i class='fas fa-angle-left'></i></a></li>";
        $forward = "<li class='pagination__item'><a href='{$this->uri}page=" . ($this->currentPage + 1) . "' class='pagination__link'><i class='fas fa-angle-right'></i></a></li>";

        if(($this->currentPage - 1) < 1){
            $back = "<li class='pagination__item'><a class='pagination__link'><i class='fas fa-angle-left'></i></a></li>";
        }
        if(($this->currentPage + 1) > $this->countPages){
            $forward = "<li class='pagination__item'><a class='pagination__link'><i class='fas fa-angle-right'></i></a></li>";
        }
        if($this->currentPage > 2){
            $startpage = "<li class='pagination__item'><a href='{$this->uri}page=1' class='pagination__link'>1</a></li>";
        }
        if($this->currentPage < ($this->countPages - 1) ){
            $endpage = "<li class='pagination__item'><a href='{$this->uri}page={$this->countPages}' class='pagination__link'>$this->countPages</a></li>";
        }
        if($this->currentPage - 3 > 0){
            $page2left = "<li class='pagination__item'><a class='pagination__link pagination__link-dotts'><i class='fas fa-ellipsis-h'></i></a></li>";
        }
        if($this->currentPage - 1 > 0){
            $page1left = "<li class='pagination__item'><a href='{$this->uri}page=" . ($this->currentPage - 1) . "' class='pagination__link'>" . ($this->currentPage - 1) . "</a></li>";
        }
        if($this->currentPage + 1 <= $this->countPages){
            $page1right = "<li class='pagination__item'><a href='{$this->uri}page=" . ($this->currentPage + 1) . "' class='pagination__link'>" . ($this->currentPage + 1) . "</a></li>";
        }
        if($this->currentPage + 3 <= $this->countPages){
            $page2right = "<li class='pagination__item'><a class='pagination__link pagination__link-dotts'><i class='fas fa-ellipsis-h'></i></a></li>";
        }

        return "<ul class='main__pagination pagination'> $back $startpage $page2left $page1left <li class='pagination__item'><a class='pagination__link pagination__link-active'>$this->currentPage</a></li> $page1right $page2right $endpage $forward";
    }

    /**
     * @return float|int
     */
    public function getCountPages(){
        return ceil($this->total / $this->perpage) ?: 1;
    }

    /**
     * @param $page
     * @return float|int|mixed
     */
    public function getCurrentPage($page){
        if(!$page || $page < 1) $page = 1;
        if($page > $this->countPages) $page = $this->countPages;
        return $page;
    }

    /**
     * @return float|int
     */
    public function getStart(){
        return ($this->currentPage - 1) * $this->perpage;
    }

    /**
     * @return string
     */
    public function getParams(){
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0] . '?';
        if(isset($url[1]) && $url[1] != ''){
            $params = explode('&', $url[1]);
            foreach($params as $param){
                if(!preg_match("#page=#", $param)) {
                    $uri .= "{$param}&amp;";
                }
            }
        }
        return $uri;
    }
}