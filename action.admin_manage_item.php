<?php
#-------------------------------------------------------------------------
# Module: MultiParser - This module lets you grab any XML, RSS or Atom Feed as well as JSON Data which you can integrate on your website.
# Fork Author: Goran Ilic - uniqu3e@gmail.com
#-------------------------------------------------------------------------
# Fork of Module: XMLMadeSimple - This module allow you to grab an XML or RSS feed and to integrate it in your website very easily. 
# Version: 0.0.1, Jean-Christophe Cuvelier
# Project Homepage: http://dev.cmsmadesimple.org/projects/xmlmadesimple
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2009 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org
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

if (isset($params['cancel'])) {
    $this->Redirect($id, 'defaultadmin', $returnid);
}
if (!isset($params['item_id']) || !($item = DoGetItems::retrieveById($params['item_id']))) {
    $item = new MultiParser_utils();
}
if (isset($params['submit']) || isset($params['apply'])) {

    $item->setTitle($params['item_title']);
    $item->setType($params['item_type']);
    $item->setItemUrl($params['item_url']);
    $item->setItemDescription($params['item_description']);
    $item->save();

    if (isset($params['submit'])) {
        $this->Redirect($id, 'defaultadmin', $returnid);
    }
}

$smarty->assign('form_start', $this->CreateFormStart($id, 'admin_manage_item', $returnid));

$smarty->assign('title_section', $this->Lang('title_section'));
$smarty->assign('title_item_title', $this->Lang('item_title'));
$smarty->assign('input_item_title', $this->CreateInputText($id, 'item_title', $item->getTitle(), 50));
$smarty->assign('item_types', $this->Lang('item_type'));
    $types = array(
        $this->Lang('xml') => 'XML', 
        $this->Lang('rss') => 'RSS', 
        $this->Lang('atom') => 'Atom', 
        $this->Lang('json') => 'JSON'
        );
$smarty->assign('input_item_type', $this->CreateInputDropdown($id, 'item_type', $types, -1, $item->getType()));
$smarty->assign('title_item_url', $this->Lang('title_item_url'));
$smarty->assign('input_item_url', $this->CreateInputText($id, 'item_url', $item->getItemUrl(), 50));
$smarty->assign('title_item_description', $this->Lang('title_item_description'));
$smarty->assign('input_item_description', $this->CreateTextArea(false, $id, $item->getItemDescription(), 'item_description', 'pagesmalltextarea', '', '', '', '40', '10'));

if ($item->getId()) {
    $smarty->assign('item_id', $this->CreateInputHidden($id, 'item_id', $item->getId()));
}

$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang('cancel')));
$smarty->assign('submit_button', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('apply_button', $this->CreateInputSubmit($id, 'apply', $this->Lang('apply')));
$smarty->assign('form_end', $this->CreateFormEnd());

echo $this->ProcessTemplate('admin.manage_item.tpl');
?>