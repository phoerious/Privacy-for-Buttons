<?php
/**
 * CommandResolver for analyzing HTTP requests.
 *
 * @author Janek Bevendorff
 * @package Pfb::FrontController
 * @since 0.1
 */
class Pfb_FrontController_HttpCommandResolver implements Pfb_Interfaces_CommandResolver
{
    /**
     * @since 0.1
     * @var string
     */
    private $defaultCommand = null;
    
    /**
     * @since 0.1
     * @var string
     */
    private $errorCommand = null;
    
    /**
     * Constructor. Initialize CommandResolver.
     * Pass the name of a default command and an error command used when a
     * command could not be found (404). Don't give the full-qualified classname, just
     * the command name (e.g. 'Index' instead of 'Pfb_Commands_Index')
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $defaultCommand
     * @return void
     */
    public function __construct($defaultCommand, $errorCommand) {
        $this->defaultCommand = $defaultCommand;
        $this->errorCommand   = $errorCommand;
    }
    
    /**
     * Analyze HTTP parameters and get the proper Command.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param Interfaces_Request $request
     * @param bool loadDefaultOnError
     * @return Interfaces_Command
     * @throws Exceptions_CommandNotFound
     */
    public function getCommand(Pfb_Interfaces_Request $request) {
        if ($request->hasParam('c')) {
            $commandName = $request->getParam('c');
            
            // validate command name
            if (!preg_match('#^[a-zA-Z]\w*$#', $commandName)) {
                return $this->loadCommand($this->errorCommand);
            }
            
            try {
                return $this->loadCommand($commandName);
            } catch (Pfb_Exceptions_CommandNotFound $ex) {
                return $this->loadCommand($this->errorCommand);
                throw $ex;
            }
        }
        return $this->loadCommand($this->defaultCommand);
    }
    
    /**
     * Load Command.
     *
     * @author Janek Bevendorff
     * @since 0.1
     *
     * @param string $commandName
     * @return Interfaces_Command
     * @throws Exceptions_CommandNotFound
     */
    private function loadCommand($commandName) {
        $className = 'Pfb_Commands_' . $commandName;
        try {
            $command = new $className();
            if (!($command instanceof Pfb_Interfaces_Command)) {
                throw new Pfb_Exceptions_CommandNotFound('Class \'' . $commandName . '\' is not a valid Command.');
            }
            return $command;
        } catch (Pfb_Exceptions_ClassNotFound $ex) {
            throw new Pfb_Exceptions_CommandNotFound('Command \'' . $commandName . '\' could not be found.');
        }
    }
}