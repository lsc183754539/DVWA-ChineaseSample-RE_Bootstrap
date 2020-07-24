<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'phpids' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ]   = 'About' . $page[ 'title_separator' ].$page[ 'title' ];
$page[ 'page_id' ] = 'about';

$page[ 'body' ] .= "
<div class=\"body_padded\">
	<h2>关于</h2>
	<p>版本 " . dvwaVersionGet() . " (Release date: " . dvwaReleaseDateGet() . ")</p>
	<p>TSWA(TaiShan Web Application)PHP / MySQL Web应用程序。它的主要目标是帮助安全专业人员在法律环境中测试他们的技能和工具，帮助网络开发人员更好地理解保护Web应用程序的过程，并帮助教师/学生在课堂环境中教授/学习Web应用程序的安全性。</p>
	<p>DVWA的官方文档 <a href=\"docs/DVWA_v1.3.pdf\">DVWA_v1.3.pdf</a>.</p>

	<h2>链接</h2>
	<ul>
		<li>主页: " . dvwaExternalLinkUrlGet( 'http://www.dvwa.co.uk/' ) . "</li>
		<li>项目主页: " . dvwaExternalLinkUrlGet( 'https://github.com/RandomStorm/DVWA' ) . "</li>
		<li>错误追踪: " . dvwaExternalLinkUrlGet( 'https://github.com/RandomStorm/DVWA/issues' ) . "</li>
		<li>源代码控制: " . dvwaExternalLinkUrlGet( 'https://github.com/RandomStorm/DVWA/commits/master' ) . "</li>
		<li>百科: " . dvwaExternalLinkUrlGet( 'https://github.com/RandomStorm/DVWA/wiki' ) . "</li>
	</ul>

	
	<h2>授权</h2>
	<p>TSWA是免费软件：您可以根据GNU[自由软件基金会（许可的版本3）或（您可以选择）任何更高版本]发布的GNU通用公共许可的条款进行重新分发、修改，</p>
	<p>DVWA发行版中真诚地包含PHPIDS库。 在没有DVWA团队支持的情况下提供了PHPIDS的操作。 根据以下许可 <a href=\"" . DVWA_WEB_PAGE_TO_ROOT . "instructions.php?doc=PHPIDS-license\">单独的条款</a> DVWA代码。</p>

	<h2>开发</h2>
	<p>欢迎每个人为DVWA尽最大的努力做出贡献和帮助。 所有贡献者的姓名和链接（如果愿意）都可以放在“积分”部分中。 要做出贡献，请从Project Home中选择一个Issue进行处理，或将补丁提交到Issues列表。</p></div>\n";

dvwaHtmlEcho( $page );

exit;

?>
