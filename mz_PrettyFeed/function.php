<?php

function mz_PrettyFeed_AddStylesheet($content)
{
  $style = mz_PrettyFeed_GetStyle();
  $stylesheet = htmlspecialchars(
    mz_PrettyFeed_Path('BinXsl', 'host') . $style . '.xsl',
    ENT_QUOTES,
    'UTF-8'
  );
  $instruction = '<?xml-stylesheet type="text/xsl" href="' . $stylesheet . '"?>';

  return preg_replace('/^(<\?xml[^?]*\?>)/', '$1' . $instruction, $content, 1);
}

function mz_PrettyFeed_GetStyle()
{
  global $zbp;

  $style = $zbp->Config('mz_PrettyFeed')->style;
  $style = in_array($style, array('minimal', 'beauty'), true) ? $style : 'beauty';
  return $style;
}

function mz_PrettyFeed_Path($file = '', $type = 'path')
{
  global $zbp;

  $path = $zbp->$type . 'zb_users/plugin/mz_PrettyFeed/';
  $paths = array(
    'VarXsl' => 'var-xsl/',
    'BinXsl' => 'bin-xsl/',
  );

  return $path . (isset($paths[$file]) ? $paths[$file] : $file);
}

function mz_PrettyFeed_BuildXsl()
{
  $sourcePath = mz_PrettyFeed_Path('VarXsl');
  $targetPath = mz_PrettyFeed_Path('BinXsl');
  $styles = array('minimal', 'beauty');

  if (!is_dir($targetPath)) {
    @mkdir($targetPath, 0755, true);
  }

  foreach ($styles as $style) {
    $xsl = @file_get_contents($sourcePath . $style . '.xsl');
    $css = @file_get_contents($sourcePath . $style . '.css');
    if ($xsl === false || $css === false) {
      continue;
    }

    $output = str_replace('/* MZ_PRETTYFEED_CSS */', $css, $xsl);
    file_put_contents($targetPath . $style . '.xsl', $output);
  }
}
