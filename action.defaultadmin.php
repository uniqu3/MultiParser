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
if (!$this->CheckAccess()) {
    return $this->DisplayErrorPage($id, $params, $returnid, $this->Lang('accessdenied'));
}
// return to active tab
if (!empty($params['active_tab'])) {
    $tab = $params['active_tab'];
} else {
    $tab = 'items';
}

$smarty->assign('tab_headers', $this->StartTabHeaders() . $this->SetTabHeader('items', $this->Lang('title_items'), ($tab == 'items')) . $this->SetTabHeader('templates', $this->Lang('title_templates'), ($tab == 'templates')) . $this->SetTabHeader('options', $this->Lang('title_options'), (isset($params['submit_options']) ? true : false), ($tab == 'otions')) . $this->EndTabHeaders() . $this->StartTabContent());
$smarty->assign('end_tab', $this->EndTab());
$smarty->assign('tab_footers', $this->EndTabContent());
$smarty->assign('start_items_tab', $this->StartTab('items'), ($tab == 'items'));
$smarty->assign('start_templates_tab', $this->StartTab('templates'), ($tab == 'templates'));
$smarty->assign('start_options_tab', $this->StartTab('options'), ($tab == 'options'));
$smarty->assign('title_section', 'defaultadmin');

// Items
include dirname(__FILE__) . '/function.admin_itemstab.php';
// Templates
include dirname(__FILE__) . '/function.admin_templatestab.php';
// Options
include dirname(__FILE__) . '/function.admin_optionstab.php';

echo $this->ProcessTemplate('adminpanel.tpl');
?>