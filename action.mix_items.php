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

if (isset($params['items_id'])) {
    if ($params['items_id'] == 'all') {
        $items = DoGetItems::doSelect();
    } else {
        $items = DoGetItems::doSelect(array('where_in' => array('id' => explode(',', $params['items_id']))));
    }

    $entries = array();

    foreach ($items as $item) {
        $items = $item->getItem();

        if (isset($items->entry)) {
            foreach ($items->entry as $entry) {
                $entries[] = $entry;
            }
        }

        if (isset($items->channel->item)) {
            foreach ($items->channel->item as $entry) {
                $entries[] = $entry;
            }
        }
    }

    if (isset($params['sort_by_date'])) {
        function compareEntryDates($a, $b) {
            return strcmp($a->published, $b->published);
        }

        usort($entries, 'compareEntryDates');
        $entries = array_reverse($entries);
    }

    if (isset($params['max_items'])) {
        $entries = array_slice($entries, 0, $params['max_items']);
    }

    $smarty->assign('items', $entries);

    if (isset($params['template']) && $this->GetTemplate($params['template'])) {
        echo $this->ProcessTemplateFromDatabase($params['template']);
    } elseif ($this->GetTemplate('default')) {
        echo $this->ProcessTemplateFromDatabase('default');
    } else {
        echo $this->GetTemplateFromFile('items');
    }
}
?>