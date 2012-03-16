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
$lang['item_title'] = 'Title';
$lang['title_section'] = 'Add/Edit Item';
$lang['title_item_description'] = 'Description';
$lang['title_item_url'] = 'Url';
$lang['xml'] = 'XML';
$lang['rss'] = 'RSS';
$lang['atom'] = 'Atom';
$lang['json'] = 'JSON';
//Export Items
$lang['exportitem_url'] = 'File URL';
//Params
$lang['help_param_action'] = 'Specifies the module action. Possible values are;
<ul>
    <li>"detail" - to display a specified item in detail mode</li>
    <li>"export" - to display a link to exported content</li>
    <li>"mix_items" - to display and combine multiple Items. This only works with Feeds like RSS or Atom.</li>
</ul>';
$lang['help_param_item_id'] = 'This parameter defines the Item (Feed, XML, JSON) that should be displayed.';
$lang['help_param_items_id'] = 'This parameter allows you to specify multiple Item ID\'s when using "mix_items" action. Works only with Feeds like RSS or Atom.';
$lang['help_param_max_items'] = 'Will limit the number of entries from a Feed like RSS or Atom.';
$lang['help_param_sort_by_date'] = 'This parameter will sort entries from a Feed like RSS or Atom by date. This parameter is only applicable with "mix_items" action.';
$lang['help_param_template'] = 'This parameter allows you specify a Template for each item.';
//Help
$lang['help_general_title'] = 'General';
$lang['help_templates_title'] = 'Templates';
$lang['help_export_title'] = 'Export';
$lang['help_about_title'] = 'About';
$lang['help_general_text'] = '
<p>This Module will allow you to easily parse a XML, RSS or Atom Feeds as well as JSON Data from a URL and display results on your Website</p>
<h3>How to use it</h3>
<p>First thing you should do is add a Item in the module "Items" tab. Simply copy a link to a XML, RSS, Atom Feed or JSON and save your new Item.<br />
After you have added a Item you should create a Template that will output content that you wish to display on your Site. If your item is a RSS or Atom feed you can try preinstalled "rss" template.</p>
<p>To show results of a Feed or JSON on your Website simply call the module tag somewhere on your page with <code>{MultiParser item_id=\'THE_ID\' template=\'rss\'}</code>.<br />
This will output your speficied Feed.';
$lang['help_templates_text'] = '
<p>To display your Items you will need templates.<br />
If you are using Items from a Feed like RSS or Atom you can use "rss" sample template as a starting point.</p>
<pre>
&lt;ul&gt;
    {foreach from=$items item=\'item\'}
        &lt;li&gt;&lt;a href="{$item->url}"&gt;{$item->title}&lt;/a&gt;&lt;/li&gt;
    {/foreach}
&lt;/ul&gt;    
</pre><br />
<p>To display whole information from Item variable simply user print_r or var_dump modifier
<pre>{$items|print_r}</pre>
or<br />
<pre>{$items|var_dump}</pre>
</p>
<h3>Example of JSON Data from Google Books</h3>
<p>You can also parse JSON or XML data, as example you can see here how to parse data from Google Books JSON using this URL https://www.googleapis.com/books/v1/volumes?q=Harry&maxResults=8&projection=lite<br />
After you add item with above URL you will need a Template that is capable of displaying Data from it. Now to find out what is returned from URL as Object you should use print_r as suggested above to have a readable Data you can work with.<br />
The output would look something like this:</p>
<pre>
stdClass Object
(
    [kind] =&gt; books#volumes
    [totalItems] =&gt; 995
    [items] =&gt; Array
        (
            [0] =&gt; stdClass Object
                (
                    [kind] =&gt; books#volume
                    [id] =&gt; LguiQgAACAAJ
                    [etag] =&gt; uYTXa/vmqA0
                    [selfLink] =&gt; https://www.googleapis.com/books/v1/volumes/LguiQgAACAAJ
                    [volumeInfo] =&gt; stdClass Object
                        (
                            [title] =&gt; Harry Potter and the chamber of secrets
                            [authors] =&gt; Array
                                (
                                    [0] =&gt; J. K. Rowling
                                )

                            [publisher] =&gt; Bloomsbury Publishing
                            [publishedDate] =&gt; 2004-07-01
                            [description] =&gt; Harry can\'t wait for his holidays with the dire Dursleys to end. But a small, self-punishing house-elf warns Harry of mortal...
                            [contentVersion] =&gt; preview-1.0.0
                            [imageLinks] =&gt; stdClass Object
                                (
                                    [smallThumbnail] =&gt; http://bks3.books.google.at/books?id=LguiQgAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api
                                    [thumbnail] =&gt; http://bks3.books.google.at/books?id=LguiQgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api
                                )

                            [previewLink] =&gt; http://books.google.at/books?id=LguiQgAACAAJ&dq=Harry&cd=1&source=gbs_api
                            [infoLink] =&gt; http://books.google.at/books?id=LguiQgAACAAJ&dq=Harry&source=gbs_api
                            [canonicalVolumeLink] =&gt; http://books.google.at/books/about/Harry_Potter_and_the_chamber_of_secrets.html?id=LguiQgAACAAJ
                        )

                    [saleInfo] =&gt; stdClass Object
                        (
                            [country] =&gt; AT
                        )

                    [accessInfo] =&gt; stdClass Object
                        (
                            [country] =&gt; AT
                            [epub] =&gt; stdClass Object
                                (
                                    [isAvailable] =&gt; 
                                )

                            [pdf] =&gt; stdClass Object
                                (
                                    [isAvailable] =&gt; 
                                )

                            [accessViewStatus] =&gt; NONE
                        )

                    [searchInfo] =&gt; stdClass Object
                        (
                            [textSnippet] =&gt; Harry can&#39;t wait for his holidays with the dire Dursleys to end.
                        )

                )
</pre>
<br />
<p>You know now that in $items variable there is "items" Array containing Information you might want to display from different Books.<br />
With the Information you have you could build a Smarty template that would display Book title, Publisher, Pubication date, Description and a Thumbnail as following.</p>
<pre>
&lt;ul&gt;
{foreach from=$items-&gt;items item=\'one\'}
        &lt;li&gt;
            &lt;h2&gt;{$one-&gt;volumeInfo-&gt;title}&lt;/h2&gt;
            {$one-&gt;volumeInfo-&gt;publisher}&lt;br /&gt;
            {$one-&gt;volumeInfo-&gt;publishedDate|cms_date_format}&lt;br /&gt;
            &lt;p&gt;{$one-&gt;volumeInfo-&gt;description}&lt;/p&gt;
            &lt;img src="{$one-&gt;volumeInfo-&gt;imageLinks-&gt;thumbnail}" /&gt;            
        &lt;/li&gt;
    
{/foreach}
&lt;/ul&gt;
</pre>
';
$lang['help_export_text'] = 'TO DO';
$lang['help_about_text'] = '<h3>Support</h3>
<p>As per the GPL, this software is provided as-is. Please read the text of the license for the full disclaimer.</p>
<h3>Copyright and License</h3>
<p><strong>Original Author of XMLMadeSimple</strong><br />
Copyright &copy; 2009, Jean-Christophe Cuvelier <a href="mailto:jcc@morris-chapman.com">&lt;jcc@morris-chapman.com&gt;</a>. <a href="http://www.morris-chapman.com" target="_new" alt="Morris & Chapman Belgium">Morris & Chapman Belgium</a>. All Rights Are Reserved.</p>
<p><strong>MultiParser Fork Author</strong><br />
Copyright &copy; 2012, Goran Ilic <a href="mailto:uniqu3e@gmail.com">&lt;uniqu3e@gmail.com&gt;</a> <a href="http://www.ich-mach-das.at" target="_blank" rel="external">www.ich-mach-das.at</a>.</p>
<p>This module has been released under the <a href="http://www.gnu.org/licenses/licenses.html#GPL">GNU Public License</a>. You must agree to this license before using the module.</p>
    <h3>Team</h3>
    <ul>
        <li>Goran Ilic (uniqu3) g.ilic@i-arts.eu <br />www.ich-mach-das.at</li> 
        <li>Fernando Morgado (JoMorg) fjmogado@gmail.com  <br />www.sm-art-lab.com</li>        
    </ul>';
//Changelog
$lang['changelog'] = '<ul>
<li>Version 0.0.2 - Feed Mixer.</li>
<li>Version 0.0.1 - 21 October 2009. Initial Release.</li>
</ul>';
$lang['help'] = '<h3>What Does This Do?</h3>
<p>Parameters:</p>
<ul>
   <li><strong>feeds_id</strong> Set to "all" or select the id\' of the feeds you want to mix separed by a comma.</p>
   <li><strong>max_items</strong> To filter the number of entries.</li>
   <li><strong>sort_by_date</strong> Will sort the feeds by published dates.</li>
</ul>';
?>
