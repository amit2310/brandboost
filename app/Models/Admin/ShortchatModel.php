<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
use Cookie;
use Session;

class ShortchatModel extends Model {


     /**
    * This function is used to add the chat shortcut
    * @param type $aData
    * @return type
    */

	public function addShortCut($aData) {
        $oData = DB::table('tbl_chat_shortcuts')->insertGetId($aData);
        return $oData;
        
    }


      /**
    * This function is used to update the chat shortcut
    * @param type $aInput
    * @param type $chatshortcutId
    * @param type $userID
    * @return type
    */

    public function updateShortCut($aInput, $chatshortcutId, $userID) {
        $oData = DB::table('tbl_chat_shortcuts')
    	 ->where('id', $chatshortcutId)
    	 ->where('user_id', $userID)->update($aInput);
           return true;
    }


   /**
    * This function is used to delete the chat shortcut
    * @param type $shortcutId
    * @param type $userID
    * @return type
    */

    public function deleteChatShortcut($shortcutId, $userID) {
        $oData = DB::table('tbl_chat_shortcuts')
    	    ->where('id', $shortcutId)
    	      ->where('user_id', $userID)->delete();
             return true;
    }


    /**
    * This function will return all the chat shortcuts
    * @param type $user_id
    * @return type
    */

    public function getChatShortcut($user_id) {
        $oData = DB::table('tbl_chat_shortcuts')
         ->where('user_id', $user_id)->get();
        return $oData;
    }


    /**
    * This function will return chatshortcutid
    * @param type $shortcutid
    * @param type $userID
    * @return type
    */
    public function getChatShortcutID($shortcutid, $userID) {
         $oData = DB::table('tbl_chat_shortcuts')
            ->where('id', $shortcutid)
              ->where('user_id', $userID)->get();
              return $oData;
        
    }
}
?>