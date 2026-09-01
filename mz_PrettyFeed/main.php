<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action = 'root';
if (!$zbp->CheckRights($action)) {
  $zbp->ShowError(6);
  die();
}
if (!$zbp->CheckPlugin('mz_PrettyFeed')) {
  $zbp->ShowError(48);
  die();
}

if (count($_POST) > 0) {
  CheckIsRefererValid();

  $style = GetVars('style', 'POST');
  if (in_array($style, array('minimal', 'beauty'), true)) {
    $zbp->Config('mz_PrettyFeed')->style = $style;
    $zbp->SaveConfig('mz_PrettyFeed');
    mz_PrettyFeed_BuildXsl();
    $zbp->SetHint('good');
  }

  Redirect('main.php');
}

$style = mz_PrettyFeed_GetStyle();
$blogtitle = '「水水」Fedd / RSS 美化';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle; ?></div>
  <div class="SubMenu">
    <a href="main.php" title="首页"><span class="m-left m-now">首页</span></a>
  </div>
  <div id="divMain2">
    <form action="<?php echo BuildSafeURL('main.php'); ?>" method="post">
      <table width="100%" class="tableBorder">
        <tr>
          <th width="18%">项目</th>
          <th>设置</th>
        </tr>
        <tr>
          <td>Feed 显示方案</td>
          <td>
            <p><label><input type="radio" name="style" value="beauty"<?php echo $style === 'beauty' ? ' checked="checked"' : ''; ?> /> RSS.Beauty 风格</label> 深色、高对比度的紧凑文章列表。</p>
            <p><label><input type="radio" name="style" value="minimal"<?php echo $style === 'minimal' ? ' checked="checked"' : ''; ?> /> 简约</label> 浅色、带文章摘要的阅读布局。</p>
          </td>
        </tr>
        <tr>
          <td></td>
          <td><input type="submit" value="保存设置" /></td>
        </tr>
      </table>
    </form>
    <p>访问 <a href="<?php echo htmlspecialchars($zbp->feedurl, ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlspecialchars($zbp->feedurl, ENT_QUOTES, 'UTF-8'); ?></a> 预览当前样式。</p>
  </div>
</div>
<?php require "about.php"; ?>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>
