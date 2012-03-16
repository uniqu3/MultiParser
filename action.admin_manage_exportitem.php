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

if (isset($params['cancel'])) {
    $this->Redirect($id, 'defaultadmin', $returnid);
}

/* TODO
 * get item
 */
$smarty->assign('form_start', $this->CreateFormStart($id, 'manage_exportitem', $returnid));

/* TODO
 * create form fields
 */

$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang('cancel')));
$smarty->assign('submit_button', $this->CreateInputSubmit($id, 'submit', $this->Lang('submit')));
$smarty->assign('apply_button', $this->CreateInputSubmit($id, 'apply', $this->Lang('apply')));
$smarty->assign('form_end', $this->CreateFormEnd());

echo $this->ProcessTemplate('admin.manage_exportitem.tpl');
?>