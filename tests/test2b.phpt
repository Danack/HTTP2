--TEST--
absoluteURI() URL: http://example.org/subdir/test.php/extra_pathinfo?abc=123
--GET--
--ENV--
HTTP_HOST=example.org
SERVER_NAME=example.org
QUERY_STRING=abc=123
SERVER_PORT=80
PATH_INFO=/extra_pathinfo
REQUEST_URI=/subdir/test.php/extra_pathinfo?abc=123
SCRIPT_NAME=/subdir/test.php
--FILE--
<?php
/**
 * All relative URI should resolve to current URI top-most folder
 *
 * In this test: /subdir/test.php/
 */
define('HTTP_RELATIVETOSCRIPT', false);
include 'absoluteURI.inc';
?>
--EXPECT--
||                     => http://example.org/subdir/test.php/extra_pathinfo?abc=123
?new=value||           => http://example.org/subdir/test.php/extra_pathinfo?new=value
#anchor||              => http://example.org/subdir/test.php/extra_pathinfo?abc=123#anchor
/page.html||           => http://example.org/page.html
page.html||            => http://example.org/subdir/test.php/page.html
page.html|http|        => http://example.org/subdir/test.php/page.html
page.html|http|80      => http://example.org/subdir/test.php/page.html
page.html|http|8080    => http://example.org:8080/subdir/test.php/page.html
page.html|https|       => https://example.org/subdir/test.php/page.html
page.html|https|443    => https://example.org/subdir/test.php/page.html
page.html||8080        => http://example.org:8080/subdir/test.php/page.html
page.html|https|8888   => https://example.org:8888/subdir/test.php/page.html
