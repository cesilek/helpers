<?php

function useDir($path, $mode = 0775) {
	if (!is_dir($path)) {
		mkdir($path, $mode, true);
	}
	return $path;
}