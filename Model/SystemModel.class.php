<?php
	class SystemModel extends FLModel {
		function password ($newpassword = NULL)
		{
			$optionModel = new OptionModel;
			if ($newpassword == NULL) {
			    return $optionModel->getvalue ('password');
			} else {
			    $optionModel->update ('password', $newpassword);
			}
		}
	}
