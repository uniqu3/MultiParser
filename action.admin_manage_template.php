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

// ROCK AND LOAD

if (isset($params['template']) && $params['template'] != '') {
    $title = $params['template'];

    if (isset($params['submitbutton']) || isset($params['applybutton'])) {
        $this->SetTemplate($params['template'], $params['templatedetails']);
        
        if (isset($params['submitbutton'])) {
            $this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'templates'));
        }
    }
} else {
    $title = '';
}

// DETAILS

$smarty->assign('form_start', $this->CreateFormStart($id, 'admin_manage_template', $returnid));

$smarty->assign('title_template', $this->Lang('title_template'));
$smarty->assign('input_template', $this->CreateInputText($id, 'template', $title, 50));
if (isset($params['restore'])) {
    $templatecode = $this -> GetTemplateFromFile('items');
} elseif (isset($params['template']) && $params['template'] != '') {
    $templatecode = $this->GetTemplate($params['template']);
} else {
    $templatecode = $this->GetTemplateFromFile('items');
}
$smarty->assign('code_template', $this->Lang('code'));
$smarty->assign('textarea_template', $this->CreateSyntaxArea($id, $templatecode, 'templatedetails', 'pagebigtextarea', 'html', '', '', 90, 15, 'EditArea'));

$smarty->assign('form_details_submit', $this->CreateInputSubmit($id, 'submitbutton', $this->Lang('submit')));
$smarty->assign('form_details_apply', $this->CreateInputSubmit($id, 'applybutton', $this->Lang('apply')));
$smarty->assign('form_details_restore', $this->CreateInputSubmit($id, 'restore', $this->Lang('restore')));

$smarty->assign('form_end', $this->CreateFormEnd());

echo $this->ProcessTemplate('admin.manage_template.tpl');
?>