<?php

namespace Source\Core;

/**
 * Class Message
 * @author Danilo Nunes de Andrade
 * @package Source\Core
 */
class Message
{
    /** @var string */
    private $message;
    
    /** @var string */
    private $type;

    /** @var array */
    private static $typeAccept = [
        CONF_MESSAGE_INFO,
        CONF_MESSAGE_SUCCESS,
        CONF_MESSAGE_WARNING,
        CONF_MESSAGE_DANGER
    ];

    /** @var array */
    private static $title = [
        CONF_MESSAGE_INFO => CONF_MESSAGE_TITLE_INFO, 
        CONF_MESSAGE_SUCCESS => CONF_MESSAGE_TITLE_SUCCESS,
        CONF_MESSAGE_WARNING => CONF_MESSAGE_TITLE_WARNING,
        CONF_MESSAGE_DANGER  => CONF_MESSAGE_TITLE_DANGER
    ];
    
    /**
     * @param  string $message
     * @param  string $type
     * @return void
     */
    public function bootstrap (string $message, string $type) : void
    {
        $this->message = $this->filter($message);

        if (in_array($type, self::$typeAccept)) {
            $this->type = $type;
        
        } else {
            $this->type = CONF_MESSAGE_INFO;
        }
    }
    
    /**
     * @return string|null
     */
    public function render(): ?string
    {
        $heading = self::$title[$this->type];

        if (!empty($this->message)) {
            return <<<KEY
                <div class='container mx-auto'>
                    <div class='alert alert-{$this->type} alert-dismissible'>
                        <h4 class='alert-heading'>{$heading}</h4>
                            {$this->message}
                        <a href='#' class='close' data-dismiss='alert'>&times;</a>
                    </div>
                </div>
                KEY;
        }
        return null;
    }
    
    /**
     * @param string $message
     * @return string
     */
    public function filter($message) : string
    {
        return filter_var($message, FILTER_SANITIZE_STRIPPED);
    }
}