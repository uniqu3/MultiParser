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

if (isset($params['item_id'])) {
    $item = MultiParser_utils::retrieveById($params['item_id']);
    $item->setAddParams(htmlspecialchars_decode($params['add_params']));

    $items = $item->getItem();
/*    
    if (isset($params['max_items'])) {
        $entries = array();
        foreach ((array)$items as $entry) {
                $entries[] = $entry;
        }
        $items = array_slice($entries, 0, $params['max_items']);
    }
*/    
    $smarty->assign('items', $items); 
    
    if (isset($items->channel->item)) {
        if (isset($params['max_items'])) {
            $entries = array();
            foreach ($items->channel->item as $entry) {
                $entries[] = $entry;
            }
            $items = array_slice($entries, 0, (int)$params['max_items']);
        } else {
            $items = $items->channel->item;
        }
        
        $smarty->assign('items', $items);
        
    } elseif (isset($items->entry)) {
        if (isset($params['max_items'])) {
            $entries = array();
            foreach ($items->entry as $entry) {
                $entries[] = $entry;
            }
            $items = array_slice($entries, 0, (int)$params['max_items']);
        } else {
            $items = $item->entry;
        }

        $smarty->assign('items', $items);
    }


    if (isset($params['template']) && $this->GetTemplate($params['template'])) {
        echo $this->ProcessTemplateFromDatabase($params['template']);
    } elseif ($this->GetTemplate('default')) {
        echo $this->ProcessTemplateFromDatabase('default');
    } else {
        echo $this->GetTemplateFromFile('items');
    }
}
?>