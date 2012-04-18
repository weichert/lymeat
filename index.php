<?php
#
# lymeat is crudely ripped off the Lemonade example Wikir.
#
# the original is licensed MIT and so is this piece.
#

# 1. loading libraries
require_once('lib/limonade.php');           # a PHP micro-framework
require_once('lib/lymeat.php');             # almost no cms

# 2. setting global options for our application
function configure()
{
  # setting environment
  $localhost = preg_match('/^localhost(\:\d+)?/', $_SERVER['HTTP_HOST']);
  $env =  $localhost ? ENV_DEVELOPMENT : ENV_PRODUCTION;
  option('env', $env);
  option('pages_dir', file_path(option('root_dir'), 'pages'));
}

# 3. code that will be executed before each controller function
function before()
{
  layout('layouts/default.html.php');
}

# 4. defining routes and controllers

# matches GET /
dispatch('/', 'page_show_index');
  function page_show_index()
  {
    $page_name = 'index';
    if($page = LymeatPage::find($page_name))
    {
      set('page_name', $page->name());
      set('page_content', $page->content());
      return html('show.html.php');
    }
  }

# matches GET /<page>
dispatch('/:page', 'page_show');
  function page_show()
  {
    $page_name = params('page');
    if($page = LymeatPage::find($page_name))
    {
      set('page_name', $page->name());
      set('page_content', $page->content());
      return html('show.html.php');
    }
  }

# 5. running the lymeat app
run();
