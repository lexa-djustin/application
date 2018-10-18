<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 18.10.2018
 * Time: 22:38
 */

namespace Components;

class AuthResult
{
    /**
     * @var $_status
     */
    protected $_status;

    /**
     * @var array $_messages
     */
    protected $_messages = [];

    /**
     * @param $message
     */
    public function addMessage($key, $message)
    {
        $this->_messages[$key] = $message;
    }

    /**
     * Get messages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->_messages;
    }

    /**
     * Set status
     *
     * @param $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * Get status
     *
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }
}