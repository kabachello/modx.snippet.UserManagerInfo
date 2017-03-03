<?php
/**
 * UserManagerInfo
 *
 * Displays information about the web user or manager currently logged in
 *
 * @category 	snippet
 * @version 	1.0
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @author      Andrej Kabachnik (kabachello@hotmail.com)
 * @internal	@modx_category Login
 * @internal    @installset base, sample
 */
 
$field = $field ? $field : null;
$userType = $userType ? strtolower($userType) : null;
if (isset($id) && (int)$id>0) {
	$id= (int)$id;
} else {
	if ($userType){
		$id = $modx->getLoginUserID(($userType=='mgr'?'mgr':'web'));
	} else {
		if (!$id = $modx->getLoginUserID('mgr')){
			$id = $modx->getLoginUserID('web');
			$userType = 'web';
		}
	}
}

if($id>0){
	if(isset($field) && $field!='internalKey'){
		if (!$userType || $userType == 'mgr'){
			$manager_data = $modx->getUserInfo($id);
		}
		if (!$userType || $userType == 'web'){
			$webuser_data = $modx->getWebUserInfo($id);
		}
		
		if (is_array($manager_data) && array_key_exists($field, $manager_data) && $manager_data[$field] !== ''){
			return $manager_data[$field];
		} elseif (is_array($webuser_data) && array_key_exists($field, $webuser_data) && $webuser_data[$field] !== ''){
			return $webuser_data[$field];
		} else {
			return '';	
		}
	} else {
		return $id;
	}
}
return '';
