<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        Time::setToStringFormat('dd-MM-YYYY');
        $this->loadComponent('Auth', [
            'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'home'
            ],
            'authError' => 'You are not authorized to do that.',
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'home',
                ''
            ],

        ]);

        $this->Auth->allow(array('controller' => 'pages', 'action' => 'help', 'help'));

    }


    public function isAuthorized($user) {
        // staff can add and edit members only!
        if ($this->request->Action === 'add') {
            return true;
        }
        if ($this->request->action === 'edit') {
            return true;
        }

        //only ADMIN can delete records
        if (in_array($this->request->action, ['delete'])) {
            if (isset($user['role']) && $user['role'] === 'admin') {
                return true;
            } else {
                $this->Flash->error(__('Only an admin is allowed to do that'));
                return false;
            }
        }

        if (isset($user['role']) && $user['role'] === 'admin' || 'staff') {
            return true;
        }

        if (isset($user['role' !== 'admin' || 'staff'])) {
            if ($this->request->action === 'forget') {
                return true;
            }
        }

        // Default deny
        return false;


        return parent::isAuthorized($user);
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event) {


        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    function uploadFiles($folder, $formdata,$imgName, $itemId = null) {

		//THIS FUNCTION NOW ACCEPTS $imgName. 

		
		
//this function is called from add and edit actions of HorseController.php with the following method call
//$fileOK = $this->uploadFiles('img/horse_images', $this->data['Horse']['horse_image']);
// setup dir names absolute and relative
//WWW_ROOT is a CakePHP constant which returns the full path to the webroot folder
        $folder_url = WWW_ROOT . $folder;
        $rel_url = $folder;
// create the folder if it does not exist
        if (!is_dir($folder_url)) {
            mkdir($folder_url);
        }

//var_dump($formdata);

// if itemId is set create an item folder
        if ($itemId) {
// set new absolute folder
            $folder_url = WWW_ROOT . $folder . '/' . $itemId;
// set new relative folder
            $rel_url = $folder . '/' . $itemId;
// create directory
            if (!is_dir($folder_url)) {
                mkdir($folder_url);
            }
        }

// list of permitted file types
        $permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');

		// replace spaces with underscores
        $filename = str_replace(' ', '_', $formdata['name']);
		// assume filetype is false
        $typeOK = false;
		// check filetype is ok
        foreach ($permitted as $type) {
			//debug('image type : '.$formdata['type']);
            if ($type == $formdata['type']){
                $typeOK = true;
                break;
            }
        }
		// if file type ok upload the file
        if ($typeOK) {
		// switch based on error code
            switch ($formdata['error']) {
                case 0:
					// create full filename 
					$currFile =  substr($formdata['name'],-5);	//takes the last 5 characters of the file. 
					$ext = substr(strstr($currFile,'.'),1); //gets the file extention. a rather round about way, but it works - for now.
					$picName = $imgName.'.'.$ext; //combine the extension AND the imgName. 
					//debug('imgName is = '.$imgName);
                    //debug('picName is = '.$picName);
					$full_url = $folder_url . '/' . $picName;
                    $url = $rel_url . '/' . $picName;
				// upload the file - overwrite existing file
                    $success = move_uploaded_file($formdata['tmp_name'], $url);

					// if upload was successful
                    if ($success) {
						//save the filename of the file
                        $result['urls'][] = $formdata['name'];
                    } else {
                        $result['errors'][] = "Error uploaded " . $formdata['name'] . "Please try again.";
                    }
                    break;
                case 3:
				// an error occurred
                    $result['errors'][] = "Error uploading " . $formdata['name'] . " Please try again.";
                    break;
                default:
				// an error occurred
                    $result['errors'][] = "System error uploading " . $formdata['name'] . "Contact webmaster.";
                    break;
            }
        } elseif ($formdata['error'] == 4) {
// no file was selected for upload
            $result['nofiles'][] = "No file Selected";
        } else {
// unacceptable file type
            $result['errors'][] = $formdata['name'] . " cannot be uploaded. Acceptable file types: gif, jpg, png.";
        }

        return $result;
    }
	
 
}
