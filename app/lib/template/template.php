<?php

namespace PHPMVC\LIB\Template;

class Template
{
    use TemplateHelper;

    private $_templateParts;
    private $action_view;
    private $_data;
    private $_registry;

    public function __get($key)
    {
        return $this->_registry->$key;
    }

    public function __construct(array $parts)
    {
        $this->_templateParts=$parts;
    }

    public function setActionViewFile($actionViewPath)
    {
        $this->action_view = $actionViewPath;
    }

    public function setAppData($data)
    {
        $this->_data=$data;
    }

    public function swapTemplate($template)
    {
        $this->_templateParts['template']= $template;
    }

    public function setRegistry($registry)
    {
       $this->_registry = $registry;
    }

    private function renderTemplateHeaderStart()
    {
        require_once TEMPLATE_PATH . 'templateheaderstart.php';
    } 

    private function renderTemplateHeaderEnd()
    {
        require_once TEMPLATE_PATH . 'templeteheaderend.php';
    }

    private function renderTemplateFooter()
    {
        require_once TEMPLATE_PATH . 'templetefooter.php';
    }

    private function renderTemplateBlocks()
    {
        if(!array_key_exists('template',$this->_templateParts)){
            trigger_error('Sorry you have to define the template blocks',E_USER_ERROR);
        }else{

            $parts= $this->_templateParts['template'];
            if (!empty($parts)){
                extract($this->_data);
                foreach ($parts as $partKey=>$file){
                    if ($partKey === ':view'){
                        require_once $this->action_view;
                    }else{
                        require_once $file;
                    }

                }
            }

        }
    }

    public function renderHeaderResources()
    {
     $outPut='';
        if(!array_key_exists('header_resources',$this->_templateParts)){
            trigger_error('Sorry you have to define the header resources',E_USER_ERROR);
        }else{
            $resources= $this->_templateParts['header_resources'];

            // Generate CSS Links
            $css=$resources['css'];
            if (!empty($css)){
                foreach ($css as $cssKey=>$path){
                    $outPut .='<link type="text/css" rel="stylesheet" href="'. $path .'"/>';
                }
            }
            // Generate JS Scripts
            $js=$resources['js'];
            if (!empty($js)){
                foreach ($js as $jsKey=>$path){
                    $outPut .='<script src="'.$path.'"></script>';
                }
            }
        }
        echo $outPut;
    }

    public function renderFooterResources()
    {
     $outPut='';
        if(!array_key_exists('footer_resources',$this->_templateParts)){
            trigger_error('Sorry you have to define the header resources',E_USER_ERROR);
        }else{
            $resources= $this->_templateParts['footer_resources'];
            // Generate JS Scripts
            if (!empty($resources)){
                foreach ($resources as $resourceKey=>$path){
                    $outPut .='<script src="'.$path.'"></script>';
                }
            }
        }
        echo $outPut;
    }

    public function renderApp()
    {
        extract($this->_data);
        $this->renderTemplateHeaderStart();
        $this->renderHeaderResources();
        $this->renderTemplateHeaderEnd();
        $this->renderTemplateBlocks();
        $this->renderFooterResources();
        $this->renderTemplateFooter();

    }
}