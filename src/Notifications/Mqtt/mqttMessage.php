<?php 
namespace SamirEltabal\EmqxAuth\Notifications\mqtt;

class mqttMessage
{
    /**
     * @var string
     */
    private string $_recipient;

    /**
     * @var string
     */
    private string $_content;

    /**
     * @return string
     */
    public function getRecipient(): string
    {
        return $this->_recipient;
    }

    /**
     * @param string $recipient
     * @return $this
     */
    public function setRecipient(string $recipient): mqttMessage
    {
        $this->_recipient = $recipient;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->_content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): mqttMessage
    {
        $this->_content = $content;
        return $this;
    }
}