<?php
namespace SfpIshikiTakaiHttps;

class StreamWrapper
{
    public $context;
    private $fp;
    private $contextHandler;

    public function __construct()
    {
        stream_wrapper_unregister('https');
        stream_wrapper_restore('https');
        $this->contextHandler = new ContextHandler;
    }

    public function stream_open($path,$mode,$options,&$opened_path)
    {
        $context = $this->contextHandler->mergeContext($path, $this->context);
        $this->fp = fopen($path, $mode, false, $context);
        return (boolean) $this->fp;
    }

    public function stream_stat()
    {
        return ($this->fp) ? fstat($this->fp) : false;
    }

    public function stream_read($count)
    {
        return ($this->fp) ? fread($this->fp, $count) : false;
    }

    public function stream_eof()
    {
        return ($this->fp) ? feof($this->fp) : false;
    }
}

