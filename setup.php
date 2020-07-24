<?php

define('DVWA_WEB_PAGE_TO_ROOT', '');
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup(array('phpids'));

$page = dvwaPageNewGrab();
$page['title'] = '安装' . $page['title_separator'] . $page['title'];
$page['page_id'] = 'setup';

if (isset($_POST['create_db'])) {
    // Anti-CSRF
    if (array_key_exists("session_token", $_SESSION)) {
        $session_token = $_SESSION['session_token'];
    } else {
        $session_token = "";
    }

    checkToken($_REQUEST['user_token'], $session_token, 'setup.php');

    if ($DBMS == 'MySQL') {
        include_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/DBMS/MySQL.php';
    } elseif ($DBMS == 'PGSQL') {
        // include_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/DBMS/PGSQL.php';
        dvwaMessagePush('尚未完全支持PostgreSQL。');
        dvwaPageReload();
    } else {
        dvwaMessagePush('错误：选择了无效的数据库。 请查看配置文件语法。');
        dvwaPageReload();
    }
}

// Anti-CSRF
generateSessionToken();

$page['body'] .= "

<div class=\"panel panel-default\">
  <!-- Default panel contents -->
  <div class=\"panel-heading\"><h1>安装数据库    <img src=\"" . DVWA_WEB_PAGE_TO_ROOT . "dvwa/images/spanner.png\" /></h1></div>
  <div class=\"panel-body\">
  <h3>
  <li>单击下面的“创建/重置数据库”按钮以创建或重置数据库。</li><br />
	<li>如果遇到错误，请检查您是否有一下文件/文件夹的使用权限： <code>" . realpath(getcwd() . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "config.inc.php") . "</code></li><br /> 

	<li>如果数据库已经存在， <em>本程序将会清除并重建该数据库</em>.</li><br />
	<li>也随时可以用<code>admin//password</code> 管理用户账户信息 </li>
	</h3>
  </div>

  <!-- Table -->
	<table class=\"table\">
	<hr/>
	<tr><h2>&nbsp;&nbsp;&nbsp;&nbsp;安装前检查</h2></tr>
	<tr>
	<td>操作系统类型</td><td>{$DVWAOS}</td>
	</tr>
	<tr>
	<td>后台数据库类型</td><td>{$DBMS}</td>
	</tr>
	<tr>
	<td>PHP 版本</td><td>" . phpversion() . "</td>
	</tr>
	<tr>
	<td>Web服务域名</td><td>{$SERVER_NAME}</td>
	</tr>
	<tr><td></td><td></td></tr>
	<tr>
	<td>PHP 函数 display_errors</td><td>{$phpDisplayErrors}</td>
	</tr>
	<tr>
	<td>PHP 函数 safe_mode</td><td>{$phpSafeMode}</td>
	</tr>
	<tr>
	<td>PHP 函数 allow_url_include</td><td>{$phpURLInclude}</td>
	</tr>
	<tr>
	<td>PHP 函数 allow_url_fopen</td><td>{$phpURLFopen}</td>
	</tr>
	<tr>
	<td>PHP 函数 magic_quotes_gpc</td><td>{$phpMagicQuotes}</td>
	</tr>
	<tr>
	<td>PHP 模块 gd</td><td>{$phpGD}</td>
	</tr>
	<tr>
	<td>PHP 模块 mysql</td><td>{$phpMySQL}</td>
	</tr>
	<tr>
	<td>PHP 模块 pdo_mysql</td><td>{$phpPDO}</td>
	</tr>
	<tr>
	<td></td><td></td>
	</tr>
	<tr>
	<td>MySQL 用户名</td><td>{$MYSQL_USER}</td>
	</tr>
	<tr>
	<td>MySQL 密码</td><td>{$MYSQL_PASS}</td>
	</tr>
	<tr>
	<td>MySQL 数据库名</td><td>{$MYSQL_DB}</td>
	</tr>
	<tr>
	<td>MySQL 地址</td><td>{$MYSQL_SERVER}</td>
	</tr>
	<tr>
		<tr>
	<td></td><td></td>
	</tr>
	<td>验证码设置</td><td>{$DVWARecaptcha}</td>
	</tr>
		<tr>
	<td></td><td></td>
	</tr>
	</table>
<table class='table'>
	<tr>
	<td>{$DVWAUploadsWrite}</td>
	</tr>		
	<tr>
	<td>{$DVWAPHPWrite}</td>
	</tr>
	<tr>
	<td>{$bakWritable}</td>
	</tr>
	<tr>
	<td><h2><br/><br/><i><span class=\"failure\">红色状态</span>,表示尝试完成某些模块时会出现问题。.</i><br />
	<br />
	如果在上方显示<code>allow_url_fopen</code>或<code>allow_url_include</code>已禁用，请在php.ini文件中设置该函数为<i>On</i>内容，然后重新启动Apache。<br /><br/>
	<pre><code>allow_url_fopen = On
allow_url_include = On</code></pre>
	如果您不想进行文件包含类型漏洞的实验，您也可以忽略该提示。</h2></td>
	</tr>
	</table>
</div>


	<!-- Create db button -->
	<form action=\"#\" method=\"post\">
	<p align='center'>
	<h2>
		<input name=\"create_db\" type=\"submit\" value=\"创建/重置数据库\" class=\"btn-group btn-group-justified\">
		" . tokenField() . "</h2>
	</p>
	</form>
	<br />
	<hr />
";

dvwaHtmlEcho($page);

?>
