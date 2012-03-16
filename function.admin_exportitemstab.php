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
if (!$this->CheckAccess()) {
    return $this->DisplayErrorPage($id, $params, $returnid, $this->Lang('accessdenied'));
}

$admintheme  = cmsms()->get_variable('admintheme');
$exportitems = '';
/* TODO
 * get saved items
 */

$smarty->assign('exportitems', $exportitems);
$smarty->assign('exportitem_title', $this->Lang('item_title'));
$smarty->assign('exportitem_type', $this->Lang('item_type'));
$smarty->assign('exportitem_url', $this->Lang('exportitem_url'));
$smarty->assign('exportitem_description', $this->Lang('item_description'));

$smarty-> assign('add_exportitem_link', $this->CreateLink($id, 'admin_manage_exportitem', '', $this->Lang('title_add_item'), array()));
$smarty-> assign('add_exportitem_icon', $this->CreateLink($id, 'admin_manage_exportitem', '', $admintheme->DisplayImage('icons/system/newobject.gif', $this -> Lang('title_add_item'), '', '', 'systemicon'), array()));
$smarty->assign('exportitems_tab', $this->ProcessTemplate('admin.exportitems_tab.tpl'));
?>