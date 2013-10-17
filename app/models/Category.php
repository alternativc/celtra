<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Urban
 * Date: 16.10.2013
 * Time: 18:25
 * To change this template use File | Settings | File Templates.
 */

class Category extends Eloquent{
    public $timestamps = false;

    public function adds(){
        return $this->hasMany('Add');
    }
}