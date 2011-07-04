<?php

# handle name, content and file for lymeat
class LymeatPage
{
  # (file)name string
  public $name = null;
  # content string
  public $content = null;

  # constructor
  public function __construct()
  {

  }

  # find the file in pages directory
  # takes   pagename as string
  # returns true if file is found
  public static function find($page_name)
  {
    $file = self::filepath($page_name);
    if(!file_exists($file)) return false;
    $page = new self();
    $page->name($page_name);
    $page->content(file_read($file, $return = true));
    return $page;
  }

  # returns a string with $name and $particle concatened
  # takes   name as string
  #         particle as string
  # returns string
  public static function filename($name, $particle = '.html')
  {
    return $name.$particle;
  }

  # return file path for $name
  # takes   name as string
  # returns string
  public static function filepath($name)
  {
    return file_path(option('pages_dir'), self::filename($name));
  }

  # return a string
  # takes   name as string
  # returns string
  public function name($name = null)
  {
    if(!is_null($name)) $this->name = $name;
    return $this->name;
  }

  # return a string
  # takes   content as string
  # returns string
  public function content($content = null)
  {
    if(!is_null($content)) $this->content = $content;
    return $this->content;
  }
}
