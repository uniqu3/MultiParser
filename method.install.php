<?php
#-------------------------------------------------------------------------
# Module: MultiParser - This module lets you grab any XML, RSS or Atom Feed as well as JSON Data which you can integrate on your website.
# This module is a fork from XMLMadeSimple created by Jean-Christophe Cuvelier.
# Original Author: Jean-Christophe Cuvelier.
# Fork Author: Goran Ilic - uniqu3e@gmail.com
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2009 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
#
#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
if (!is_object(cmsms())) exit;

$db          = cmsms()->GetDb();
$taboptarray = array('mysql' => 'TYPE=MyISAM');
$dict        = NewDataDictionary($db);

$flds = "
			id I KEY,
			title C(255),
			type C(255),
			item_url C(255),
			item_description X
	   ";

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . "module_multiparser_item", $flds, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

$db->CreateSequence(cms_db_prefix() . "module_multiparser_item_seq");

// install a default template
$this->SetTemplate('default', '
<pre>{$items|print_r}</pre>
');
// sample rss template
$this->SetTemplate('rss', '
<ul>
    {foreach from=$items item=\'item\'}
        <li><a href="{$item->url}">{$item->title}</a></li>
    {/foreach}
</ul>
');
// permissions
$this->CreatePermission('Manage MultiParser', 'Manage MultiParser');
// Preferences
$this->setPreference('cache', 900);
// Templates
$this->setPreference('auth_sites', serialize(array()));
// put mention into the admin log
$this->Audit(0, $this->Lang('friendlyname'), $this->Lang('installed', $this->GetVersion()));
?>