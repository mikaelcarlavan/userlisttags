<?php
/* Copyright (C) 2004-2017 Laurent Destailleur  <eldy@users.sourceforge.net>
 * Copyright (C) 2017 Mikael Carlavan <contact@mika-carl.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *  \file       htdocs/userlisttags/class/actions_userlisttags.class.php
 *  \ingroup    userlisttags
 *  \brief      File of class to manage actions
 */
require_once DOL_DOCUMENT_ROOT.'/core/class/commonobject.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/class/html.form.class.php';
require_once DOL_DOCUMENT_ROOT.'/user/class/usergroup.class.php';
require_once DOL_DOCUMENT_ROOT.'/comm/action/class/actioncomm.class.php';
require_once DOL_DOCUMENT_ROOT.'/contact/class/contact.class.php';
require_once DOL_DOCUMENT_ROOT.'/societe/class/societe.class.php';
require_once DOL_DOCUMENT_ROOT.'/categories/class/categorie.class.php';
require_once DOL_DOCUMENT_ROOT . '/user/class/usergroup.class.php';


class ActionsUserListTags
{
    function printFieldListOption($parameters, &$object, &$action, $hookmanager)
    {
        global $langs, $db, $mysoc, $conf, $user;

        $langs->load('userlisttags@userlisttags');

        if (!empty($arrayfields['tags']['checked'])) {
            print '<td class="liste_titre">';
            print '</td>';
        }

        return 0;
    }

    function printFieldListTitle(&$parameters, &$object, &$action, $hookmanager)
    {
        global $langs, $db, $mysoc, $conf, $user;

        $langs->load('userlisttags@userlisttags');

        $arrayfields = $parameters['arrayfields'] ?? array();
        $totalarray = $parameters['totalarray'] ?? array();
        $param = $parameters['param'] ?? '';
        $sortorder = $parameters['sortorder'] ?? '';
        $sortfield = $parameters['sortfield'] ?? '';


        if (!empty($arrayfields['tags']['checked'])) {
            print_liste_field_titre($arrayfields['tags']['label'], $_SERVER['PHP_SELF'], "", $param, "", "", $sortfield, $sortorder);
            $totalarray['nbfield']++;
        }

        return 0;
    }

    function printFieldListValue(&$parameters, &$object, &$action, $hookmanager)
    {
        global $langs, $db, $mysoc, $conf, $user;

        $langs->load('userlisttags@userlisttags');

        $arrayfields = $parameters['arrayfields'] ?? array();
        $totalarray = $parameters['totalarray'] ?? array();
        $i = $parameters['i'] ?? '';
        $obj = $parameters['obj'] ?? '';

        $form = new Form($db);

        if (!empty($arrayfields['tags']['checked'])) {
            print '<td class="center">';
            print $form->showCategories($obj->rowid, Categorie::TYPE_USER, 1);
            print '</td>';
            if (!$i) {
                $totalarray['nbfield']++;
            }
        }

        return 0;
    }

    function doActions($parameters, &$object, &$action, $hookmanager)
    {
        global $langs, $db, $mysoc, $conf, $user, $arrayfields;

        $langs->load('userlisttags@userlisttags');

        if ($object->element == 'user' && empty($object->id)) {
            $arrayfields['tags'] = array('label'=>$langs->trans('Categories'), 'checked'=>0, 'position'=>9999);
        }
    }
}


