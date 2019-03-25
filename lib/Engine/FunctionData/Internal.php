<?php

namespace PHPPHP\Engine\FunctionData;

use PHPPHP\Engine;

class Internal extends Base {
    protected $callback;

    public function __construct($callback, $byRef = false, array $params = array()) {
        $this->callback = $callback;
        $this->byRef    = $byRef;
        $this->params   = $params;
    }

    public function execute(Engine\Executor $executor, array $args, Engine\Zval\Ptr $return, \PHPPHP\Engine\Objects\ClassInstance $ci = null, \PHPPHP\Engine\Objects\ClassEntry $ce = null) {
        if ($this->checkParams($executor, $args, true)) {
            call_user_func_array($this->callback, array($executor, $args, $return, $ci, $ce));
        } else {
            $return->setValue(null);
        }
    }

}
