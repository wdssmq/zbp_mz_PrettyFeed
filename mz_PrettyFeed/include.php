<?php
require_once __DIR__ . '/function.php';

RegisterPlugin("mz_PrettyFeed", "ActivePlugin_mz_PrettyFeed");

function ActivePlugin_mz_PrettyFeed()
{
  Add_Filter_Plugin('Filter_Plugin_Feed_Begin', 'mz_PrettyFeed_Begin');
  Add_Filter_Plugin('Filter_Plugin_Feed_End', 'mz_PrettyFeed_End');
}

function mz_PrettyFeed_Begin()
{
  ob_start('mz_PrettyFeed_AddStylesheet');
}

function mz_PrettyFeed_End()
{
  $buffer = ob_get_status();
  if (isset($buffer['name']) && $buffer['name'] === 'mz_PrettyFeed_AddStylesheet') {
    ob_end_flush();
  }
}

function InstallPlugin_mz_PrettyFeed()
{
  global $zbp;
  if (!$zbp->HasConfig('mz_PrettyFeed')) {
    $zbp->Config('mz_PrettyFeed')->version = 1;
    $zbp->Config('mz_PrettyFeed')->style = 'beauty';
    $zbp->SaveConfig('mz_PrettyFeed');
  }

  mz_PrettyFeed_BuildXsl();
}

function UninstallPlugin_mz_PrettyFeed() {}
