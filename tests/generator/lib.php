<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Description of blcok_my_picture_generator
 *
 * @author jpeak5
 */
class block_my_picture_generator extends phpunit_block_generator {
    
    public function create_instance($record = null, array $options = null) {
        global $DB, $CFG;
        require_once("$CFG->dirroot/mod/page/locallib.php");

        $this->instancecount++;

        $options = array(
            'ready_url'     =>  'https://tt.lsu.edu/api/v2/json/kZabUZ6TZLcsYsCnV6KW/photos/recently_updated/%s',
            'webservice_url'=>  'https://tt.lsu.edu/api/v2/jpg/kZabUZ6TZLcsYsCnV6KW/photos/lsuid/%s?skip_place_holder=true',
            'update_url'    =>  'https://tt.lsu.edu/api/v2/jpg/kZabUZ6TZLcsYsCnV6KW/photos/lsuid/%s/update',
            'fetch'         =>  1,
            'cron_users'    =>  100
        );
        
        $record = (object)(array)$record;
        $options = (array)$options;

        $record = $this->prepare_record($record);

        $id = $DB->insert_record('block_instances', $record);
        context_block::instance($id);

        $instance = $DB->get_record('block_instances', array('id'=>$id), '*', MUST_EXIST);

        return $instance;
    }
}

?>