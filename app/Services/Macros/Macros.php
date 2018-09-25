<?php

namespace App\Services\Macros;

use Collective\Html\FormBuilder;


/**
 * Class Macros
 * @package App\Http
 */
class Macros extends FormBuilder
{

    /**
     * @param $name
     * @param null $selected
     * @param array $options
     * @return string
     */
    public function selectUserType($name, $selected = null, $options = array())
    {
        $list = [
            '' => trans('Select One...'),
            '1' => trans('backend.user.traveler'),
            '0' => trans('backend.user.user'),

        ];
        return $this->select($name, $list, $selected, $options);
    }

    public function tagInput($name, $selected = null, $options = array())
    {
        $value = null;
        foreach ($selected as $key => $tag) {
            $value .= $tag->name . ',';
        }
        return $this->text($name, $value, $options);
    }
}