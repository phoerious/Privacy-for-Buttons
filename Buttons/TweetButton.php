<?php
/**
 * Tweet button for server-side PHP API.
 *
 * @package Pfb::Buttons
 * @author Janek Bevendorff
 * @since 0.1
 */
class Pfb_Buttons_TweetButton implements Pfb_Interfaces_Button
{
    /**
     * @since 0.1
     * @var array
     */
    private $params = array(
        // URL for the button
        'url' => null,
        // Button layout
        'type' => 'vertical',
        // Button language
        'lang' => 'en'
    );
    
    /**
     * @since 0.1
     * @var Pfb_Interfaces_Model
     */
    private $model;
    
    
    /**
     * Initialize button.
     *
     * @author Janek Bevendorf
     * @since 0.1
     * 
     * @param string $referenceUrl
     * @return void
     */
    public function init($referenceUrl) {
        $this->params['url'] = $referenceUrl;
        $this->model         = new Pfb_Models_TweetButtonModel($referenceUrl);
    }
    
    /**
     * Set Parameter for Tweet button.
     *
     * @author Janek Bevendorff
     * @since 0.1
     * 
     * @param string | array $nameOrDataArray
     * @param string $value
     * @return void
     */
    public function setParam($nameOrDAtaArray, $value) {
        if (is_array($nameOrDAtaArray)) {
            foreach ($nameOrDAtaArray as $key => $value) {
                if ($key == 'type') {
                    if (in_array($value, array('vertical', 'horizontal', 'none'))) {
                        $this->params[$key] = $value;
                    } else {
                        $this->params[$key] = 'none';
                    }
                    continue;
                }
                
                $this->params[$key] = $value;
            }
        } else {
            if ($nameOrDAtaArray == 'type') {
                if (in_array($value, array('vertical', 'horizontal', 'none'))) {
                    $this->params[$nameOrDAtaArray] = $value;
                } else {
                    $this->params[$nameOrDAtaArray] = 'none';
                }
                return;
            }
            
            $this->params[$nameOrDAtaArray] = $value;
        }
    }
    
    /**
     * Get raw HTML code for button (without styling).
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return string
     */
    public function getButtonCode() {
        $view = new Pfb_FrontController_TemplateView('TweetButton');
        $view->assignVar('url', $this->params['url']);
        $view->assignVar('lang', $this->params['lang']);
        $view->assignVar('count', $this->model->getCounter());
        $view->assignVar('locales', $this->model->getLocales($this->params['lang']));
        $view->assignVar('buttonOnly', true);
        $view->assignVar('type', $this->params['type']);
        
        return $view->render();
    }
    
    /**
     * Get CSS code for button.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return string
     */
    public function getButtonCSS() {
        $view = new Pfb_FrontController_TemplateView('TweetButtonCSS');
        $view->assignVar('path', Pfb_Config::getConfig('publicApplicationPath'));
        
        return $view->render();
    }
    
    /**
     * Get counter for button.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return int
     */
    public function getCounter() {
        return (int)$this->model->getCounter();
    }
    
    /**
     * Get the model object for this button.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @return Pfb_Interfaces_Model
     */
    public function getModel() {
        return $this->model;
    }
}