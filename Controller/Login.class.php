<?php
    class Login extends FLController {
        function run () {
            $this->view->render ();
        }
        function ajaxLogin () {
            /** 检查 */
			if (empty ($_POST['password'])) {
				exit (json_encode (array ('code' => -9999, 'msg' => '参数为空')));
			}
			
			/** 初始化 */
			$systemModel = new SystemModel;
			
			/** 返回 */
			if ($_POST['password'] == $systemModel->password ()) {
				exit (json_encode (array ('code' => 0)));
			} else {
				exit (json_encode (array ('code' => -1, 'msg' => '密码错误')));
			}
        }
    }
