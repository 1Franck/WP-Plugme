<?php
/**
 * Alpha validator
 */
class plugme_form_validator_alpha extends plugme_form_validator
{
    /**
     * Default validator options
     * @var array
     */
    public $default_options = array(
        'lower'  => true,
        'upper'  => true,
        'french' => true,
        'space'  => false,
        'punc'   => array()
    );

    /**
     * Validate data
     * 
     * @return bool
     */
    public function validate()
    {
        
        $o = $this->options; 

        $regopt = array();

        if($o['lower']) $regopt[] = 'a-z';
        if($o['upper']) $regopt[] = 'A-Z';
        if($o['french']) $regopt[] = 'À-ÿ';
        if($o['space']) $regopt[] = '\s';

        if(is_array($o['punc']) && (!empty($o['punc'])) {
            foreach($o['punc'] as $punc) {
                $regopt[] = '\\'.$punc;
            }
        }
        elseif(!empty($opt['punc'])) {
            $punc   = $o['punc'];
            $strlen = strlen($punc);
            for($i = 0; $i < $strlen; $i++) {
                $regopt[] = '\\'.$punc{$i};
            }
        }

        return filter_var($v, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^['.implode('',$regopt).']+$/')));        
    }
}