<?php 


namespace Main\Controller;

use Rain\Tpl;

/**
 * Class ContactPage
 * 
 */
class ContactPage 
{
    public function __construct() 
    {
        $this->tpl = new Tpl;
    }   

    // rendenriza as páginas
    public function index($nameview='contact', $title='Contact Page') 
    {   
        // Array data exemple
        $data = [
            "name" => "Marina",
            "email" => "marina@gmail.com",
            "telefone" => "12222-5555"
        ];
        
        $this->tpl->assign('data', $data);

        $this->tpl->assign('title', $title);

        $this->tpl->draw($nameview);
    }
}