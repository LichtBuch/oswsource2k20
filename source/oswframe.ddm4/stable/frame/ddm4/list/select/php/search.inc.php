<?php

/**
 * This file is part of the osWFrame package
 *
 * @author Juergen Schwind
 * @copyright Copyright (c) JBS New Media GmbH - Juergen Schwind (https://jbs-newmedia.com)
 * @package osWFrame
 * @link https://oswframe.com
 * @license MIT License
 */

$data=$this->getListElementOption($key, 'data');

if (count(array_filter(array_keys($data), 'is_string'))>0) {
	$ddm_search_case_array[]=$this->getGroupOption('alias', 'database').'.'.$key.' LIKE '.self::getConnection()->escapeString('%'.$search['value'].'%');
} else {
	$ids=[];
	if (($data!=[])&&($data!='')) {
		foreach ($data as $_key=>$_value) {
			if (intval($_key)==$_key) {
				if (stristr($_value, $search['value'])!==false) {
					$ids[]=$_key;
				}
			}
		}
	}

	if ($ids!=[]) {
		$ddm_search_case_array[]=$this->getGroupOption('alias', 'database').'.'.$key.' IN ('.implode(',', $ids).')';
	}
}

?>