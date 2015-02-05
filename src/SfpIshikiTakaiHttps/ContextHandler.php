<?php
namespace SfpIshikiTakaiHttps;

use Humbug\FileGetContents;

class ContextHandler extends FileGetContents
{
    public function mergeContext($filename, $context)
    {
        $this->options = array_merge_recursive(
            stream_context_get_options($context),
            $this->options
        );

        return $this->getStreamContext($filename);
    }
}

