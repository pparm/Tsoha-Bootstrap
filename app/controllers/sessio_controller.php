<?php

    class SessioController extends BaseController{
        public static function logout(){
            $_SESSION['laakari'] = null;
            $_SESSION['asiakas'] = null;
            
            Redirect::to('/');
        }
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

