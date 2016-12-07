<?php
    class ErrorModel extends FLModel {
        public function __construct () {
            set_error_handler (array ($this, 'errorHandler'));
            set_exception_handler (array ($this, 'exceptionHandler'));
            parent::__construct ();
        }
        public function errorHandler ($errno, $errstr, $errfile, $errline) {
            $this->sendError ('-1001078722237', '在 ' . $errfile . ' 的第 ' . $errline . ' 行发生了一个错误：' . "\n" . $errstr);
        }
        public function exceptionHandler ($exception) {
            $errstr = '';
            foreach ($exception->getTrace () as $i => $ep_d) {
                $errstr .= '在 ' . $ep_d['file'] . ' 的第 ' . $ep_d['line'] . ' 行发生了一个异常：' . "\n";
                if (!empty ($ep_d['class'])) {
					$errstr .= $ep_d['class'] . '->';
				}
				if (!empty ($ep_d['function'])) {
				    $errstr .= $ep_d['function'] . ' ';
				    $errstr .= '(';
					
					if (!empty ($ep_d['args'])) {
						$errstr .= var_export ($ep_d['args'], true);
					}
					
					$errstr .= ')';
				}
				$errstr .= "\n";
            }
            $this->sendError ('-1001078722237', $errstr);
        }
        public function sendError ($chat_id = '-1001078722237', $text = '发生了一个错误') {
            // 初始化变量
            $url = 'https://api.telegram.org/bot' . TOKEN . '/sendMessage';
            $postdata = [
                'chat_id' => $chat_id,
                'text' => $text
            ];
            
            // 发送报告
            $ch = curl_init ();
    		curl_setopt ($ch, CURLOPT_URL, $url);
    		curl_setopt ($ch, CURLOPT_POSTFIELDS, $postdata);
    		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
    		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    		$re = curl_exec ($ch);
    		curl_close ($ch);
    		
    		// 结束
            die ();
        }
    }