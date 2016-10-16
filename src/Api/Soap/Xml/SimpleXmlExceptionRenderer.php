<?php

namespace ThreeDCart\Api\Soap\Xml;

class SimpleXmlExceptionRenderer
{
    /** @var array */
    private $libXmlErrors;
    
    /**
     * @param array $libXmlErrors
     */
    public function __construct(array $libXmlErrors = array())
    {
        $this->libXmlErrors = $libXmlErrors;
    }
    
    /**
     * @return string
     */
    public function getErrorMessage()
    {
        $messages = array();
        foreach ($this->libXmlErrors as $libXmlError) {
            $messages[] = $this->getErrorLevelName($libXmlError->level) . ' ' . $libXmlError->code . ': '
                . str_replace("\n", '', $libXmlError->message) . ' on line ' . $libXmlError->line . ' in column '
                . $libXmlError->column;
        }
        
        return implode("\n", $messages);
    }
    
    /**
     * @param int $errorLevel
     *
     * @return string
     */
    private function getErrorLevelName($errorLevel)
    {
        if (!is_int($errorLevel)) {
            return '';
        }
        switch ($errorLevel) {
            case LIBXML_ERR_WARNING:
                return 'Warning';
                break;
            case LIBXML_ERR_FATAL:
                return 'Fatal Error';
                break;
            default:
            case LIBXML_ERR_ERROR:
                return 'Error';
                break;
        }
    }
}
