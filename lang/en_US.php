<?php
//Common
$lang['friendlyname'] = 'Multi Parser';
$lang['postinstall'] = 'Module installed.';
$lang['postuninstall'] = 'Module uninstalled.';
$lang['really_uninstall'] = 'Really? Are you sure you want to unsinstall this fine module?';
$lang['uninstalled'] = 'Module Uninstalled.';
$lang['installed'] = 'Module version %s installed.';
$lang['upgraded'] = 'Module upgraded to version %s.';
$lang['moddescription'] = 'This module allow you to grab an XML or RSS feed and to integrate it in your website very easily. ';
$lang['error'] = 'Error!';
$land['admin_title'] = 'MultiParser Admin Panel';
$lang['admindescription'] = 'This module allow you to grab an XML or RSS feed and to integrate it in your website very easily. ';
$lang['accessdenied'] = 'Access Denied. Please check your permissions.';
$lang['postinstall'] = 'Be sure to set "Manage MultiParser" or "Modify Site Preferences" permissions to use this module!';
$lang['items'] = 'Items';
$lang['areyousure'] = 'Are you sure?';
$lang['submit'] = 'Submit';
$lang['apply'] = 'Apply';
$lang['restore'] = 'Restore';
$lang['cancel'] = 'Cancel';
// Tabs
$lang['title_items'] = 'Items';
$lang['title_exportitems'] = 'Export Items';
$lang['title_templates'] = 'Templates';
$lang['title_options'] = 'Options';
//Templates
$lang['title_add_template'] = 'Add template';
$lang['title_template'] = 'Template title';
$lang['code'] = 'Code';
$lang['edit_template'] = 'Edit Template';
$lang['delete_template'] = 'Delete Template';
// Options
$lang['options_title'] = 'Options';
$lang['cache'] = 'Feed cache timeout';
$lang['auth_url'] = 'Authorized url';
//Items
$lang['item_title'] = 'Title';
$lang['item_type'] = 'Item Type';
$lang['item_description'] = 'Description';
$lang['item_url'] = 'Url';
$lang['item_tag'] = 'Tag';
$lang['title_add_item'] = 'Add Item';
$lang['title_item_title'] = 'Title';
$lang['title_item_description'] = 'Description';
$lang['title_item_url'] = 'Url';
$lang['xml'] = 'XML';
$lang['rss'] = 'RSS';
$lang['atom'] = 'Atom';
$lang['json'] = 'JSON';
//Export Items
$lang['exportitem_url'] = 'File URL';
$lang['template_help'] = 'You can use the {$xml} parameter for your template (see help for more information).';

$lang['changelog'] = '<ul>
<li>Version 0.0.2 - Feed Mixer.</li>
<li>Version 0.0.1 - 21 October 2009. Initial Release.</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>This module allow you to grab an XML or RSS feed and to integrate it in your website very easily. </p>
<h3>How Do I Use It</h3>
<p>Create your feed and template (default template is "default" one.) and then use {cms_module module="XMLMadeSimple" id="The_id_of_your_feed"}</p>
<h3>Template vars</h3>
<p>You can use {$xml} to navigate trough your xml. ({$xml|var_dump} can help a little bit). If you define a max items number you can use the {$feeds} variable.</p>
<h3>What Parameters Does It Take</h3>
<p>You can specify the template to use with template="my_template" parameter.</p>
<h3>Feed Mixer</h3>
<p>If your xml sources are rss feeds, you can mix them together using the action mixfeed. It will mix the feeds together. {cms_module module="XMLMadeSimple" action="mixfeed"}. It will give you a {$feeds} containing all the feeds entries.</p>
<p>Parameters:</p>
<ul>
   <li><strong>feeds_id</strong> Set to "all" or select the id\' of the feeds you want to mix separed by a comma.</p>
   <li><strong>max_items</strong> To filter the number of entries.</li>
   <li><strong>sort_by_date</strong> Will sort the feeds by published dates.</li>
</ul>
<h3>Support</h3>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>
<h3>Copyright and License</h3>
<p>Copyright &copy; 2009, Jean-Christophe Cuvelier <a href="mailto:jcc@morris-chapman.com">&lt;jcc@morris-chapman.com&gt;</a>. <a href="http://www.morris-chapman.com" target="_new" alt="Morris & Chapman Belgium">Morris & Chapman Belgium</a>. All Rights Are Reserved.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>';
?>
