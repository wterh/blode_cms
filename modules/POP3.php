<?php
/**
 * PHPMailer POP-Before-SMTP Authentication Class.
 * PHP Version 5.5.
 *
 * @see       https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 *
 * @author    Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 * @author    Jim Jagielski (jimjag) <jimjag@gmail.com>
 * @author    Andy Prevost (codeworxtech) <codeworxtech@users.sourceforge.net>
 * @author    Brent R. Matzelle (original founder)
 * @copyright 2012 - 2017 Marcus Bointon
 * @copyright 2010 - 2012 Jim Jagielski
 * @copyright 2004 - 2009 Andy Prevost
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note      This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace PHPMailer\PHPMailer;

class POP3
{
    const VERSION = '6.0.5';
    const DEFAULT_PORT = 110;
    const DEFAULT_TIMEOUT = 30;
    public $do_debug = 0;
    public $host;
    public $port;
    public $tval;
    public $username;
    public $password;
    protected $pop_conn;
    protected $connected = false;
    protected $errors = [];
    const LE = "\r\n";

    public static function popBeforeSmtp(
        $host,
        $port = false,
        $timeout = false,
        $username = '',
        $password = '',
        $debug_level = 0
    ) {
        $pop = new self();

        return $pop->authorise($host, $port, $timeout, $username, $password, $debug_level);
    }

    public function authorise($host, $port = false, $timeout = false, $username = '', $password = '', $debug_level = 0)
    {
        $this->host = $host;
        // If no port value provided, use default
        if (false === $port) {
            $this->port = static::DEFAULT_PORT;
        } else {
            $this->port = (int) $port;
        }
        // If no timeout value provided, use default
        if (false === $timeout) {
            $this->tval = static::DEFAULT_TIMEOUT;
        } else {
            $this->tval = (int) $timeout;
        }
        $this->do_debug = $debug_level;
        $this->username = $username;
        $this->password = $password;
        //  Reset the error log
        $this->errors = [];
        //  connect
        $result = $this->connect($this->host, $this->port, $this->tval);
        if ($result) {
            $login_result = $this->login($this->username, $this->password);
            if ($login_result) {
                $this->disconnect();

                return true;
            }
        }
        // We need to disconnect regardless of whether the login succeeded
        $this->disconnect();

        return false;
    }

    public function connect($host, $port = false, $tval = 30)
    {
        //  Are we already connected?
        if ($this->connected) {
            return true;
        }

        set_error_handler([$this, 'catchWarning']);

        if (false === $port) {
            $port = static::DEFAULT_PORT;
        }

        //  connect to the POP3 server
        $this->pop_conn = fsockopen(
            $host, //  POP3 Host
            $port, //  Port #
            $errno, //  Error Number
            $errstr, //  Error Message
            $tval
        ); //  Timeout (seconds)
        //  Restore the error handler
        restore_error_handler();

        //  Did we connect?
        if (false === $this->pop_conn) {
            //  It would appear not...
            $this->setError(
                "Failed to connect to server $host on port $port. errno: $errno; errstr: $errstr"
            );

            return false;
        }

        //  Increase the stream time-out
        stream_set_timeout($this->pop_conn, $tval, 0);

        //  Get the POP3 server response
        $pop3_response = $this->getResponse();
        //  Check for the +OK
        if ($this->checkResponse($pop3_response)) {
            //  The connection is established and the POP3 server is talking
            $this->connected = true;

            return true;
        }

        return false;
    }

    public function login($username = '', $password = '')
    {
        if (!$this->connected) {
            $this->setError('Not connected to POP3 server');
        }
        if (empty($username)) {
            $username = $this->username;
        }
        if (empty($password)) {
            $password = $this->password;
        }

        // Send the Username
        $this->sendString("USER $username" . static::LE);
        $pop3_response = $this->getResponse();
        if ($this->checkResponse($pop3_response)) {
            // Send the Password
            $this->sendString("PASS $password" . static::LE);
            $pop3_response = $this->getResponse();
            if ($this->checkResponse($pop3_response)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Disconnect from the POP3 server.
     */
    public function disconnect()
    {
        $this->sendString('QUIT');
        //The QUIT command may cause the daemon to exit, which will kill our connection
        //So ignore errors here
        try {
            @fclose($this->pop_conn);
        } catch (Exception $e) {
            //Do nothing
        }
    }

    protected function getResponse($size = 128)
    {
        $response = fgets($this->pop_conn, $size);
        if ($this->do_debug >= 1) {
            echo 'Server -> Client: ', $response;
        }

        return $response;
    }

    protected function sendString($string)
    {
        if ($this->pop_conn) {
            if ($this->do_debug >= 2) { //Show client messages when debug >= 2
                echo 'Client -> Server: ', $string;
            }

            return fwrite($this->pop_conn, $string, strlen($string));
        }

        return 0;
    }

    protected function checkResponse($string)
    {
        if (substr($string, 0, 3) !== '+OK') {
            $this->setError("Server reported an error: $string");

            return false;
        }

        return true;
    }

    protected function setError($error)
    {
        $this->errors[] = $error;
        if ($this->do_debug >= 1) {
            echo '<pre>';
            foreach ($this->errors as $e) {
                print_r($e);
            }
            echo '</pre>';
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    protected function catchWarning($errno, $errstr, $errfile, $errline)
    {
        $this->setError(
            'Connecting to the POP3 server raised a PHP warning:' .
            "errno: $errno errstr: $errstr; errfile: $errfile; errline: $errline"
        );
    }
}
