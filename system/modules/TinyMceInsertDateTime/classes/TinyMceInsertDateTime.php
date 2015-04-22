<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2014-2015
 * @author     Cliff Parnitzky
 * @package    TinyMceInsertDateTime
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace TinyMceInsertDateTime;

/**
* Class TinyMceInsertDateTime
*
* Class to implement the HOOK for adding configs.
* @copyright  Cliff Parnitzky 2014-2015
* @author     Cliff Parnitzky
*/
class TinyMceInsertDateTime {
	
	// mapping table to transform PHP date format into prefered format of TinyMCE
	private $arrMapping = array(
		'd' => '%d',
		'D' => '%a',
		'j' => '%d',
		'l' => '%A',
		'F' => '%B',
		'm' => '%m',
		'M' => '%b',
		'n' => '%m',
		'o' => '%Y',
		'Y' => '%Y',
		'y' => '%y',
		'a' => '%p',
		'A' => '%p',
		'g' => '%I',
		'G' => '%H',
		'h' => '%I',
		'H' => '%H',
		'i' => '%M',
		's' => '%S'
	);
	
	/**
	 * Adding config for output behavoir
	 */
	public function editTinyMcePluginLoaderConfig ($arrTinyConfig) {
		$arrTinyConfig["plugin_insertdate_dateFormat"] = '"' . $this->transformFormat($GLOBALS['TL_CONFIG']['dateFormat']) . '"';
		$arrTinyConfig["plugin_insertdate_timeFormat"] = '"' . $this->transformFormat($GLOBALS['TL_CONFIG']['timeFormat']) . '"';
		return $arrTinyConfig;
	}
	
	/**
	 * Transforms a format from PHP into TinyMCE preferred
	 */
	private function transformFormat($strFormat)
	{
		$arrFormatTokens = str_split($strFormat);
		
		foreach ($arrFormatTokens as $i => $token)
		{
			if (ctype_alpha($token))
			{
				$arrFormatTokens[$i] = $this->arrMapping[$token];
			}
		}
		
		return implode('', $arrFormatTokens);
	}
}
 
?>