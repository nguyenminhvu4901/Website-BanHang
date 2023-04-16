<?php
class Session
{
    static public function data($key = '', $value = '')
    {
        $sessionKey = Session::isInvalid();
        if (!empty($value)) {
            if (!empty($key)) {
                $_SESSION[$sessionKey][$key] = $value; //set sessions
                return true;
            }
            return false;
        } else {
            if (empty($key)) {
                if (isset($_SESSION[$sessionKey])) {
                    return $_SESSION[$sessionKey]; //Get all session 
                }
            } else {
                if (isset($_SESSION[$sessionKey][$key])) {
                    return $_SESSION[$sessionKey][$key]; //get session
                }
            }
        }
    }
    // Xoa session neu co key
    // Ko co key thi xoa het session
    static public function delete($key = '')
    {
        $sessionKey = Session::isInvalid();
        if (!empty($key)) {
            if (isset($_SESSION[$sessionKey][$key])) {
                unset($_SESSION[$sessionKey][$key]);
                return true;
            }
            return false;
        } else {
            unset($_SESSION[$sessionKey]);
            return true;
        }
        return false;
    }

    static public function flash($key = '', $value = '')
    {
        $dataFlash = self::data($key, $value);
        if (empty($value)) {
            self::delete($key);
        }
        return $dataFlash;
    }

    static public function showErrors($message)
    {
        $data = ['message' => $message];
        App::$app->loadError('Exception', $data);
        die();
    }

    static function isInvalid()
    {
        global $config;
        if (!empty($config['session'])) {
            $sessionConfig = $config['session'];
            if (!empty($sessionConfig['session_key'])) {
                $sessionKey = $sessionConfig['session_key'];
                return $sessionKey;
            } else {
                self::showErrors('Thiếu cấu hình sessionKey. Vui lòng kiểm tra lại file: configs/session.php');
            }
        } else {
            self::showErrors('Thiếu cấu hình session. Vui lòng kiểm tra lại file: configs/session.php');
        }
    }
}
