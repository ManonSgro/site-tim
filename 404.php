<?php
$page = get_page_by_title('404');
wp_redirect(get_permalink($page->ID));
exit;
?>