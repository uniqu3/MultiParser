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

$smarty->assign('form_start', $this->CreateFormStart($id, 'defaultadmin', $returnid));
$smarty->assign('form_end', $this->CreateFormEnd());

$smarty->assign('options_title', $this->Lang('options_title'));
if (isset($params['submit_options']) && isset($params['cache']) && is_numeric($params['cache']) && $params['cache'] > 0) {
    $this->SetPreference('cache', $params['cache']);
}

$smarty->assign('cache_title', $this->Lang('cache'));
$smarty->assign('cache', $this->CreateInputText($id, 'cache', $this->GetPreference('cache')));

// Authorized sites

$auth_sites = unserialize($this->getPreference('auth_sites'));

if (!is_array($auth_sites)) {
    $auth_sites = array();
}

if (isset($params['auth_url']) && $params['auth_url'] != '') {
    if (array_search($params['auth_url'], $auth_sites) === false) {
        $auth_sites[] = $params['auth_url'];
        $this->setPreference('auth_sites', serialize($auth_sites));
    }
}

$sites = array();

foreach ($auth_sites as $site) {
    $sites[] = array('url' => $site, 'delete' => $this->CreateLink($id, 'delete_auth_url', $returnid, $admintheme->DisplayImage('icons/system/delete.gif', $site, '', '', 'systemicon'), array('url' => $site), ''));
}

$smarty->assign('auth_sites', $sites);
$smarty->assign('auth_url_title', $this->Lang('auth_url'));
$smarty->assign('auth_url', $this->CreateInputText($id, 'auth_url', null, 80));

$smarty->assign('submit_options', $this->CreateInputSubmit($id, 'submit_options', $this->Lang('submit')));
$smarty->assign('cancel', $this->CreateInputSubmit($id, 'cancel', $this->Lang('cancel')));

$smarty->assign('options_tab', $this->ProcessTemplate('admin.options_tab.tpl'));
?>