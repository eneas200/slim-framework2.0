<?php 


namespace Main\Controller;

use Rain\Tpl;

/**
 * Class HomePage
 * 
 */
class HomePage 
{
    public function __construct() 
    {
        $this->tpl = new Tpl;
    }   
    
    // rendenriza as páginas
    public function index($nameview='index', $title='Home Page') 
    {
        $this->tpl->assign('title', $title);
        $this->tpl->draw($nameview);
            
    }
}