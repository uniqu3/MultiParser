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

$template_list = $this->ListTemplates();
$templates     = array();

foreach ($template_list as $template) {
    $onerow = new stdClass();

    $onerow->name       = $template;
    $onerow->deletelink = $this->CreateLink($id, 'delete_template', $returnid, $admintheme->DisplayImage('icons/system/delete.gif', $this->Lang('delete_template'), '', '', 'systemicon'), array('template' => $template), $this->Lang('areyousure'));
    $onerow->editlink   = $this->CreateLink($id, 'manage_template', $returnid, $admintheme->DisplayImage('icons/system/edit.gif', $this->Lang('edit_template'), '', '', 'systemicon'), array('template' => $template));
    $templates[]        = $onerow;
}

$smarty->assign('templates', $templates);
$smarty->assign('title_template', $this->Lang('title_template'));
$smarty->assign('addtemplatelink', $this->CreateLink($id, 'manage_template', '', $this -> Lang('title_add_template'), array()));
$smarty->assign('addtemplateicon', $this->CreateLink($id, 'manage_template', '', $admintheme -> DisplayImage('icons/system/newobject.gif', $this->Lang('title_add_template'), '', '', 'systemicon'), array()));
$smarty->assign('templates_tab', $this->ProcessTemplate('admin.templates_tab.tpl'));
?>