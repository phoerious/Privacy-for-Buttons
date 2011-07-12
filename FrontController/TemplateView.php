<?php
/**
 * Manage templates/views.
 *
 * @package Pfb::FrontController
 * @author Janek Bevendorff
 * @since 0.1
 */
class Pfb_FrontController_TemplateView
{
    /**
     * @since 0.1
     * @var array
     */
    private $templateVars = array();
    
    /**
     * @since 0.1
     * @var string
     */
    private $viewName;
    
    /**
     * @since 0.1
     * @var array
     */
    private $renderedTemplates;
    
    /**
     * Constructor. Pass view name to this method. Don't give the fully-qualified
     * class name, just the view name. This should normally be the same as the
     * command name.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $viewName
     * @return void
     */
    public function __construct($viewName) {
        $this->viewName = $viewName;
    }
    
    /**
     * Set variable to pass to the view template.
     * You can also pass an array of key => value pairs to the first parameter.
     * Omit the second one if you do so.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string | array $nameOrVarArray
     * @param mixed $value
     * @return void
     */
    public function assignVar($nameOrVarArray, $value) {
        if (is_array($nameOrVarArray)) {
            foreach ($nameOrVarArray as $key => $value) {
                $this->templateVars[$key] = $value;
            }
        } else {
            $this->templateVars[$nameOrVarArray] = $value;
        }
    }
    
    /**
     * Render view and return its output.
     * This method doesn't write anything to screen. Use display() for this.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $viewName
     * @param return string
     */
    public function render($viewName = null) {
        if (null === $viewName) {
            $viewName = $this->viewName;
        }
        
        if (!isset($this->renderedTemplates[$viewName])) {
            // use quick'n'dirty method for template rendering: include and output buffering
            ob_start();
            include PFB_CONFIG_APP_PATH . '/Views/' . $viewName . '.php';
            $this->renderedTemplates[$viewName] = ob_get_clean();
        }
        
        return $this->renderedTemplates[$viewName];
    }
    
    /**
     * Render view and send output to the client user agent.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param Pfb_Interfaces_Request $request
     * @param Pfb_Interfaces_Response $response
     * @return void
     */
    public function display(Pfb_Interfaces_Request $request, Pfb_Interfaces_Response $response) {
        $response->write($this->render($this->viewName));
        $response->flush();
    }
    
    /**
     * Provide template variables to views.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $varName
     * @param return mixed
     */
    public function __get($varName) {
        if (isset($this->templateVars[$varName])) {
            return $this->templateVars[$varName];
        }
        return null;
    }
}