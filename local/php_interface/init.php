<?php

if ( ! function_exists('debugfile')) {
    function debugfile($message,$file = "debugSM.dbg",$path = "/upload/debug/") {
        $message = is_array($message) ? print_r($message,1) : $message;
        $log_path = $_SERVER['DOCUMENT_ROOT'].$path;
        CheckDirPath($log_path,true);
        $log_file = $log_path.$file;
        $info = debug_backtrace();
        $info = $info[0];
        $info['file'] = substr($info['file'],strlen($_SERVER['DOCUMENT_ROOT']));
        $where = "{$info['file']}:{$info['line']}";
        $str = $where."\r\n".$message."\r\n";
        $content = file_get_contents($log_file);
        file_put_contents($log_file,$content.$str);
    }
}