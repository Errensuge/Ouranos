<?php

namespace App\Jobs;

class CreateFromPDFJob extends Job
{
    protected $file;
    protected $path;

    public function __construct($f, $p)
    {
      $this->file = $f;
      $this->path = $p;
    }

    public function handle()
    {
      $i = new \Imagick($this->file);
      $i->setImageFormat('jpg');
      $i->scaleImage(0, 150);
      $i->writeImage($this->path, false);
    }
}
