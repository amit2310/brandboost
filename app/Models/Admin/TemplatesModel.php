<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class TemplatesModel extends Model {

    /**
     * This function used to get Common templates which used in all modules
     * @param type $userID
     * @param type $categoryID
     * @param type $id
     * @param type $templateType
     * @param type $bHideStaticTemplate
     * @return type
     */
    public function getCommonTemplates($userID = 0, $categoryID = '', $id = '', $templateType = '', $bHideStaticTemplate = false) {
        $oData = DB::table('tbl_common_templates')
                ->leftJoin('tbl_common_templates_categories', 'tbl_common_templates.category_id', '=', 'tbl_common_templates_categories.id')
                ->select('tbl_common_templates.*', 'tbl_common_templates_categories.category_name', 'tbl_common_templates_categories.status AS category_status', 'tbl_common_templates_categories.module_name')
                ->when(!empty($userID), function ($query) use ($userID) {
                    return $query->where('tbl_common_templates.user_id', $userID);
                }, function ($query) {
                    return $query->where('tbl_common_templates.user_id', 0);
                })
                ->when(($categoryID > 0), function($query) use ($categoryID) {
                    return $query->where('tbl_common_templates.category_id', $categoryID);
                })->when(!empty($templateType), function($query) use ($templateType) {
                    return $query->where('tbl_common_templates.template_type', $templateType);
                })
                ->when(($id > 0), function($query) use ($id) {
                    return $query->where('tbl_common_templates.id', $id);
                })
                ->when(($bHideStaticTemplate == true), function($query) {
                    return $query->where('tbl_common_templates_categories.status', '!=', 2);
                })
                ->get();
        return $oData;
    }

    /**
     * Used to get Draft Templates(This function is deprecated)-Needs to verify whether or not should remove this function or not
     * @param type $userID
     * @param type $id
     * @param type $templateType
     * @return boolean
     */
    public function getCommonDraftTemplates($userID = '', $id, $templateType = '') {
        $oData = DB::table('tbl_common_templates_drafts')
                ->when(!empty($id), function ($query) use ($id) {
                    return $query->where('id', $id);
                })
                ->when(!empty($templateType), function ($query) use ($templateType) {
                    return $query->where('template_type', $id);
                })
                ->orderBy('id', 'desc')
                ->get();
        return $oData;
    }

    /**
     * Used to get common template categories
     * @return boolean
     */
    public function getCommonTemplateCategories() {
        $oData = DB::table('tbl_common_templates_categories')
                ->get();
        return $oData;
    }

    /**
     * Get Template Tags
     * @return type
     */
    public function getTemplateTags() {
        $aTags = config('bbconfig.email_tags');
        return $aTags;
    }

    /**
     * Get Common template info
     * @param type $templateID
     * @param type $slug
     * @return boolean
     */
    public function getCommonTemplateInfo($templateID = '', $slug = '') {
        $oData = DB::table('tbl_common_templates')
                ->when(($templateID > 0), function ($query) use ($templateID) {
                    return $query->where('id', $templateID);
                })
                ->when(!empty($slug), function ($query) use ($slug) {
                    return $query->where('template_slug', $slug);
                })
                ->first();
        return $oData;
    }

    /**
     * This function used to check duplicate template name 
     * @param type $sName
     * @param type $userID
     * @return boolean
     */
    public function checkIfTemplateNameExists($sName, $userID) {
        $bExists = DB::table('tbl_common_templates')
                ->where('template_name', $sName)
                ->where('user_id', $userID)
                ->exists();

        return $bExists;
    }

    /**
     * Used to add user template which return last insert id
     * @param type $aData
     * @return type
     */
    public function addUserTemplate($aData) {
        $insert_id = DB::table('tbl_common_templates')->insertGetId($aData);
        return $insert_id;
    }

    /**
     * This function is used to update user template
     * @param type $aData
     * @param type $templateID
     * @param type $userID
     * @return boolean
     */
    public function updateCommonTemplate($aData, $templateID, $userID) {
        if ($templateID > 0) {
            $result = DB::table('tbl_common_templates')
                    ->where('id', $templateID)
                    ->where('user_id', $userID)
                    ->update($aData);
            if ($result)
                return true;
        }
        return false;
    }

    /**
     * Used to  delete a user template
     * @param type $templateID
     * @param type $userID
     * @return boolean
     */
    public function deleteUserTemplate($templateID, $userID) {
        $result = DB::table('tbl_common_templates')
                ->where('id', $templateID)
                ->where('user_id', $userID)
                ->delete();
        if ($result) {
            return true;
        }
        return false;
    }

}
