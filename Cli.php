<?php

namespace Krystof\Utils;


/**
 * Cli
 *
 * @author Kryštof Česal
 */
class Cli {

	const COLOR_BLACK = '0;30';
	const COLOR_DARK_GRAY = '1;30';
	const COLOR_RED = '0;31';
	const COLOR_LIGHT_RED = '1;31';
	const COLOR_GREEN = '0;32';
	const COLOR_LIGHT_GREEN = '1;32';
	const COLOR_BROWN = '0;33';
	const COLOR_YELLOW = '1;33';
	const COLOR_BLUE = '0;34';
	const COLOR_LIGHT_BLUE = '1;34';
	const COLOR_PURPLE = '0;35';
	const COLOR_LIGHT_PURPLE = '1;35';
	const COLOR_CYAN = '0;36';
	const COLOR_LIGHT_CYAN = '1;36';
	const COLOR_LIGHT_GRAY = '0;37';
	const COLOR_WHITE = '1;37';

	static $statusOld;


	static function color($string, $color, $newLine = true) {
		return "\033[" . $color . "m$string\033[0m" . ($newLine ? "\n" : "");
	}


	static function prompt($yesOrNo = false) {
		$handle = fopen("php://stdin", "r");
		$line = trim(fgets($handle));
		if ($yesOrNo) {
			$line = strtolower($line);
			if (in_array($line, ['yes', 'y', 'no', 'n'])) {
				return ($line == 'yes' || $line == "y");
			} else {
				echo 'Type yes or no: ';
				return self::prompt(true);
			}
		} else {
			return $line;
		}
	}


	static function progressBar($percents) {
		$cols = exec('tput cols');
		$statusCalc = round(($percents / 100) * $cols);
		if (self::$statusOld === $statusCalc) {
			return;
		}
		self::$statusOld = $statusCalc;
		echo "\r\033[K[";
		for ($i = 0; $i < ($cols - 2); $i++) {
			if ($i > $statusCalc) {
				echo " ";
			} else {
				echo "|";
			}
		}
		echo "]";
	}
} 
