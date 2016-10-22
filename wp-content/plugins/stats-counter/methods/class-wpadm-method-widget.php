<?php

if (!class_exists('WPAdm_Method_Widget')) {
    class WPAdm_Method_Widget extends WPAdm_Method_Class {
        // get result
        public function getResult()
        {
            WPAdm_Core::log("start widget method", __CLASS__);
            $this->result->setData('not result');
            wpadm_wp_stat::on_activate();
            if (isset($this->params['side'])) {
                $this->deleteWidget();
                $this->addWidget($this->params['side']);
            }
            $this->result->setResult(WPAdm_result::WPADM_RESULT_SUCCESS);
            return $this->result;
        }

        public function addWidget($sidebar_id = false)
        {
            $message = wpadm_wp_stat::addWidget($sidebar_id);
            if ($message) {
                $this->result->setData($message);
            }
           
        }
        public function deleteWidget()
        {
              return wpadm_wp_stat::deleteWidget();
        }
    }
}