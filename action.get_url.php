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

$urlaction = isset($params['urlaction']) ? $params['urlaction'] : 'default';
unset($params['urlaction']);

$detailpage = $returnid;
if (isset($params['detailpage'])) {
    $manager =& cmsms()->GetHierarchyManager();
    $node =& $manager->sureGetNodeByAlias($params['detailpage']);
    if (isset($node)) {
        $content =& $node->GetContent();
        if (isset($content))
        {
            $detailpage = $content->Id();
        }
    } else {
        $node =& $manager->sureGetNodeById($params['detailpage']);
        if (isset($node)) {
            $detailpage = $params['detailpage'];
        }
    }

    $params['origid'] = $returnid;
}


echo $this->createLink($id, $urlaction, $detailpage, $contents='', $params, '', true);

?>