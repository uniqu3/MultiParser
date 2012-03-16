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
# This file originally created by ModuleMaker module, version 0.3.1
# Copyright (c) 2009 by Samuel Goldstein (sjg@cmsmadesimple.org)
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

class MultiParser extends CMSModule {

    function GetName() {
        return 'MultiParser';
    }

    function GetFriendlyName() {
        return $this->Lang('friendlyname');
    }

    function GetVersion() {
        return '1.0';
    }

    function GetHelp() {
        $smarty = cmsms()->GetSmarty();
        
        $smarty->assign('help_general_title', $this->Lang('help_general_title'));
        $smarty->assign('help_general_text', $this->Lang('help_general_text'));
        $smarty->assign('help_templates_title', $this->Lang('help_templates_title'));
        $smarty->assign('help_templates_text', $this->Lang('help_templates_text'));
        $smarty->assign('help_export_title', $this->Lang('help_export_title'));
        $smarty->assign('help_export_text', $this->Lang('help_export_text'));
        $smarty->assign('help_about_title', $this->Lang('help_about_title'));
        $smarty->assign('help_about_text', $this->Lang('help_about_text'));

        return $this -> ProcessTemplate('help.tpl');
    }

    function GetAuthor() {
        return 'Jean-Christophe Cuvelier';
    }

    function GetAuthorEmail() {
        return 'jcc@morris-chapman.com';
    }

    function GetChangeLog() {
        return $this->Lang('changelog');
    }

    function IsPluginModule() {
        return true;
    }

    function HasAdmin() {
        return true;
    }

    function GetAdminSection() {
        return 'content';
    }

    function GetAdminDescription() {
        return $this->Lang('admindescription');
    }

    function VisibleToAdminUser() {
        return true;
    }

    function CheckAccess() {
        return $this->CheckPermission('Manage MultiParser') || 
               $this->CheckPermission('Modify Site Preferences');
    }

    function DisplayErrorPage($id, &$params, $return_id, $message = '') {
        $smarty->assign('title_error', $this->Lang('error'));
        $smarty->assign_by_ref('message', $message);

        echo $this->GetTemplateFromFile('error');
    }

    function GetDependencies() {
        return array();
    }

    function MinimumCMSVersion() {
        return '1.9.4';
    }

    function MaximumCMSVersion() {
        return '1.10.3';
    }

    function InstallPostMessage() {
        return $this->Lang('postinstall');
    }

    function UninstallPostMessage() {
        return $this->Lang('postuninstall');
    }

    function UninstallPreMessage() {
        return $this->Lang('really_uninstall');
    }
    
    public function SetParameters() {
        if (version_compare(CMS_VERSION, '1.10') < 0) {
            $this->InitializeFrontend();
            $this->InitializeAdmin();
        }
    }    

    function InitializeFrontend() {
        $this->RegisterModulePlugin();
        $this->RestrictUnknownParams();

        $this->SetParameterType('action', CLEAN_STRING);
        $this->SetParameterType('item_id', CLEAN_INT);
        $this->SetParameterType('items_id', CLEAN_STRING);
        $this->SetParameterType('item', CLEAN_STRING);
        $this->SetParameterType('max_items', CLEAN_STRING);
        $this->SetParameterType('sort_by_date', CLEAN_STRING);
        $this->SetParameterType('template', CLEAN_STRING);
        $this->SetParameterType('detailpage', CLEAN_STRING);
    }

    function InitializeAdmin() {
        $this->CreateParameter('action', 'default', $this->Lang('help_param_action'));
        $this->CreateParameter('item_id', '', $this->Lang('help_param_item_id'), $optional = false);
        $this->CreateParameter('items_id', '', $this->Lang('help_param_items_id'));
        $this->CreateParameter('max_items', '', $this->Lang('help_param_max_items'));
        $this->CreateParameter('sort_by_date', '', $this->Lang('help_param_sort_by_date'));
        $this->CreateParameter('template', 'default', $this->Lang('help_param_template'));
    }

    function LazyLoadFrontend() {
        return true;
    }

    function LazyLoadAdmin() {
        return true;
    }

    function checkWebsite($url) {
        $auth_sites = unserialize($this->getPreference('auth_sites'));

        foreach ($auth_sites as $site) {
            if (strpos($url, $site) === 0) {
                return true;
            }
        }

        return false;
    }

}
?>
